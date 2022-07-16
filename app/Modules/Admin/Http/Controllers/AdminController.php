<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Models\Admin;
use App\Validators\AdminValidator;
use App\Validators\BaseValidatorInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Prettus\Validator\Exceptions\ValidatorException;

class AdminController extends AppController
{
    /**
     * @var AdminValidator
     */
    protected $validator;

    /**
     * @var Admin
     */
    protected $admin;

    public function __construct(AdminValidator $validator)
    {
        $this->validator = $validator;
        $this->admin = new Admin();
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->admin->orderBy('id', 'desc');

        if ($request->has('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('username', 'like', '%'.$request->keyword.'%')
                    ->orWhere('email', 'like', '%'.$request->keyword.'%');
            });
        }
        $paginates = $query->paginate(PAGE_NUMBER);

        return view('Admin::admins.index', compact('paginates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleQuery = Role::orderBy('name', 'asc');
        if(!auth()->user()->can('role-list')) {
            $roleQuery = $roleQuery->where('id', '<', '3');
        }
        $roles = $roleQuery->get();

        return view('Admin::admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(BaseValidatorInterface::RULE_CREATE);
        } catch (ValidatorException $e) {
            return redirect(route('admin.admins.create'))->withErrors($e->getMessageBag())->withInput();
        }

        $formData = $request->all();

        if (!isset($formData['avatar']) || empty($formData['avatar'])) {
            $formData['avatar'] = '/images/default_user.png';
        }

        $admin = $this->admin->create($formData);
        $admin->assignRole($request->input('roles'));

        return redirect()->route('admin.admins.edit', $admin->id)->with('success', __('Thêm mới thành công'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $roleQuery = Role::orderBy('name', 'asc');
        if(!auth()->user()->can('role-list')) {
            $roleQuery = $roleQuery->where('id', '<', '3');
        }
        $roles = $roleQuery->get();
        $adminRoles = $admin->roles->pluck('id')->toArray();

        return view('Admin::admins.edit', compact('adminRoles', 'adminPermissions', 'roles', 'permissions'))->with('dataEdit', $admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Admin $admin, Request $request)
    {
        try {
            $this->validator->with($request->all())->setId($admin->id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            return redirect(route('admin.admins.edit', $admin->id))->withErrors($e->getMessageBag())->withInput();
        }

        $formData = $request->all();
        $admin->update($formData);

        $adminRoles = $admin->roles->pluck('name', 'name')->all();
        foreach ($adminRoles as $value) {
            $admin->removeRole($value);
        }

        $roles = Role::whereIn('id', $request->input('roles'))->pluck('name', 'id')->all();
        $admin->assignRole($roles);

        return redirect()->route('admin.admins.edit', $admin->id)->with('success', __('Cập nhật thành công'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        // $adminRole = $admin->roles->pluck('name', 'name')->all();
        // foreach ($adminRole as $value) {
        //     $admin->removeRole($value);
        // }

        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', __('Xóa thành công'));
    }

    /**
     * admin login get.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        if (Auth()->guard('admin')->user()) {
            return redirect(route('admin.dashboards.index'));
        }

        return view('Admin::admins.login');
    }

    /**
     * admin login submit.
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function signIn(Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(BaseValidatorInterface::RULE_LOGIN);
        } catch (ValidatorException $e) {
            return redirect(route('admin.login'))->withErrors($e->getMessageBag())->withInput();
        }

        $data = $request->all();
        $remember = isset($data['remember']) ? true : false;

        if (Auth()->attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
            if (Auth()->user()->status != STATUS_ACTIVE) {
                $request->session()->flash('login-error', __('Your account has been locked.'));
                Auth()->logout();

                return redirect(route('admin.login'))->withInput();
            }
            if (Auth()->user()->role != 'admin') {
                $request->session()->flash('login-error', __('User is not administrator.'));
                Auth()->logout();

                return redirect(route('admin.login'))->withInput();
            }

            $url = self::_getRedirectUrl();

            return redirect($url);
        } else {
            $request->session()->flash('login-error', __('Wrong username or password.'));

            return redirect(route('admin.login'))->withInput();
        }
    }

    public function logout()
    {
        Auth()->logout();

        return redirect(route('admin.login'));
    }

    public function changePassword()
    {
        return view('Admin::admins.change-password');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth()->user();
        try {
            $this->validator->with($request->all())->passesOrFail(BaseValidatorInterface::CHANGE_PASSWORD_ADMIN);
        } catch (ValidatorException $e) {
            $request->session()->flash('error', __('Cập nhật mật khẩu thất bại'));
            if (!Hash::check($request->oldpassword, Auth()->user()->password) && isset($request->oldpassword)) {
                $request->session()->flash('error-old-password', __('Mật khẩu cũ không đúng.'));
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
        if (Hash::check($request->oldpassword, Auth()->user()->password)) {
            $admin->password = $request->password;
            $admin->save();

            return redirect()->back()->with('success', __('cập nhật mật khẩu thành công'));
        } else {
            $request->session()->flash('error', __('Cập nhật mật khẩu thất bại'));

            return redirect()->back()->with('error-old-password', __('Mật khẩu cũ không đúng'))->withInput();
        }
    }

    /**
     * @return string
     */
    private function _getRedirectUrl()
    {
        if (Session::has('admin_redirect_url')) {
            $url = Session::get('admin_redirect_url');
            Session::forget('admin_redirect_url');
        } else {
            $url = route('admin.dashboards.index');
        }

        return $url;
    }
}
