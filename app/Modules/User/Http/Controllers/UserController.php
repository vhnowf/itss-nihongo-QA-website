<?php

namespace App\Modules\User\Http\Controllers;


use Mail;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Validators\UserValidator;
use App\Modules\User\Mail\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Modules\User\Mail\ForgotPassword;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends AppController
{
    /**
     * @var UserValidator
     */
    private $userValidator;

    public function __construct(UserValidator $userValidator)
    {
        $this->userValidator = $userValidator;
    }

    /**
     * admin login submit.
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        try {
            $this->userValidator->with($request->all())->passesOrFail(BaseValidatorInterface::RULE_LOGIN);
        } catch (ValidatorException $e) {
            return json_encode([
                'status' => 400,
                'message' => __('Log in failed'),
                'data' => $e->getMessageBag(),
            ]);
        }

        $data = $request->all();
        $remember = true;
        if (Auth()->attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
            $status = 200;
            $mesage = __('Log in successful');
            if (Auth()->user()->status == STATUS_VERIFY) {
                $status = 403;
                $mesage = __('Account của chưa được xác thực, vui lòng kiểm tra email để xác thực Account.');
                Auth()->logout();
            } elseif (Auth()->user()->status == STATUS_DISABLE) {
                $status = 403;
                $mesage = __('Account của bạn đã bị khóa, liên hệ Quản trị viên để lấy lại Account.');
                Auth()->logout();
            }
        } else {
            $status = 403;
            $mesage = __('Sai địa chỉ email hoặc mật khẩu.');
        }

        if ($status == 200) {
            $data = [
                'user' => Auth::user()
            ];
        }

        return json_encode([
            'status' => $status,
            'message' => $mesage,
            'data' => $data
        ]);
    }
    /**
     * register a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $this->userValidator->with($request->all())->passesOrFail(BaseValidatorInterface::RULE_CREATE);
        } catch (ValidatorException $e) {
            return json_encode([
                'status' => 400,
                'message' => __('Account registration failed.'),
                'data' => $e->getMessageBag(),
            ]);
        }
     
        $dataForm = $request->all();
        $dataForm['status'] = STATUS_ACTIVE;
        $dataForm['role'] = 'user';
        // $dataForm['social'] = 'web';

        $user = User::create($dataForm);

        // Auth()->attempt(['email' => $dataForm['email'], 'password' => $dataForm['password']], true);

        // sendmail
        // Mail::to($request->email)->send(new Register());

        return json_encode([
            'status' => 200,
            'message' => __('Account registration successful.'),
            'data' => Auth::user()
        ]);
    }

    public function forgotPassword(Request $request)
    {
        try {
            $this->userValidator->with($request->all())->passesOrFail(BaseValidatorInterface::RESET_PASSWORD);
        } catch (ValidatorException $e) {
            return json_encode([
                'status' => 400,
                'message' => __('Bad Request'),
                'data' => $e->getMessageBag(),
            ]);
        }

        $user = User::Where(['email' => $request->email, 'status' => STATUS_ACTIVE])->first();
        if ($user) {
            $randomPass = Str::random(8);
            $user->password = $randomPass;
            $user->save();
            Mail::to($user->email)->send(new ForgotPassword($user, $randomPass));

            return json_encode([
                'status' => 200,
                'message' => __('Thay đổi mật khẩu thành công. Vui lòng kiểm tra email của bạn để lấy lại mật khẩu mới.'),
            ]);
        } else {
            return json_encode([
                'status' => 403,
                'message' => __('Địa chỉ email không tồn tại trong hệ thống.'),
            ]);
        }
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::guard('web')->logout();
        }

        return redirect(url()->previous());
    }

    public function verifyAccount($token)
    {
        $user = User::Where(['token' => $token])->first();
        if ($user) {
            $user->status = STATUS_ACTIVE;
            $user->token = '';
            $user->save();

            return redirect(route('verify.success'))->with('success', __('Account của bạn đã được xác thực thành công!'));
        }
        if (!$user) {
            return response(__('đường dẫn không tồn tại.'), 404);
        }
    }

    public function verifySuccess()
    {
        return view('User::users.verify-success');
    }

    public function profile()
    {
        $user = Auth::user();

        return view('User::users.profile', compact('user'));
    }

    public function detail($id)
    {
        $user = User::with('questions.tag', 'answers', 'comments')->find($id);

        return view('User::users.profile', compact('user'));
    }

    public function activity($id)
    {
        $user = User::with('questions.tag', 'answers', 'comments')->find($id);

        return view('User::users.activity', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        try {
            $this->userValidator->with($request->all())->setId($user->id)->passesOrFail(BaseValidatorInterface::EDIT_PROFILE);
        } catch (ValidatorException $e) {
            $request->session()->flash('error', __('Cập nhật thông tin cá nhân thất bại'));

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $destinationDir = public_path('/uploads/users');
            $extension = $request->avatar->getClientOriginalExtension();
            $filename = $user->id . '-' . time() . '.' . $extension;
            $request->avatar->move($destinationDir, $filename);
            $credentials['avatar'] = '/uploads/users/' . $filename;
            $data['avatar'] = $credentials['avatar'];
        }
        $user->update($data);

        return redirect()->back()->with('success', __('Cập nhật thông tin cá nhân thành công'));
    }

    public function changePassword()
    {
        return view('User::users.change-password', compact('breadcrumbs', 'meta'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        try {
            $this->userValidator->with($request->all())->passesOrFail(BaseValidatorInterface::CHANGE_PASSWORD);
        } catch (ValidatorException $e) {
            $request->session()->flash('error', __('Cập nhật mật khẩu thất bại'));
            if (!Hash::check($request->old_password, Auth::user()->password) && isset($request->old_password)) {
                $request->session()->flash('error-old-password', __('Mật khẩu cũ không đúng'));
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $user->password = $request->new_password;
            $user->save();

            return redirect()->back()->with('success', __('Update password successful'));
        } else {
            $request->session()->flash('error', __('Update password failed'));

            return redirect()->back()->with('error-old-password', __('Mật khẩu cũ không đúng'))->withInput();
        }
    }
    
    public function showQuestion(Request $request, $id)
    {
        $user = User::with('questions.tag', 'answers', 'comments')->find($id);

        $questions = Question::where([
            ['owner_id', '=', $id],
            ['status', '=', 2],
        ])->paginate(5);

        $quantity = Question::where([
            ['owner_id', '=', $id],
        ])->count();

        return view('User::users.questions', compact('questions', 'quantity', 'user'));
    }

    public function showAnswer(Request $request, $id)
    {
        $user = User::with('questions.tag', 'answers', 'comments')->find($id);

        $answers = Answer::where([
            ['user_id', '=', $id],
        ])->paginate(PAGE_NUMBER);

        $quantity = Answer::where([
            ['user_id', '=', $id],
        ])->count();

        return view('User::users.answers', compact('answers', 'quantity', 'user'));
    }

    public function showList(Request $request) 
    {
        $query = User::with('questions.tag');
        if ($request->keyword) {
            $query->where('fullname', 'like', '%'.$request->keyword.'%')
                ->orWhere('username', 'like', '%'.$request->keyword.'%');
        }
        $users = $query->paginate(8);
        // dd($users);
        return view('User::users.list', compact('users'));
    }
}
