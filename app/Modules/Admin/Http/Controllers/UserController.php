<?php

namespace App\Modules\Admin\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Validators\AdminUserValidator;
use App\Validators\BaseValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends AppController
{
    /**
     * @var AdminUserValidator
     */
    protected $user;
    protected $validator;

    public function __construct(AdminUserValidator $validator)
    {
        $this->validator = $validator;
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->user->orderBy('id', 'desc');
        if ($request->has('keyword')) {
            $query = $query->where(function ($q) use ($request) {
                $q->where('fullname', 'like', '%'.$request->keyword.'%')
                    ->orWhere('email', 'like', '%'.$request->keyword.'%');
            });
        }

        $paginates = $query->paginate(PAGE_NUMBER);

        return view('Admin::users.index', compact('paginates'));
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

        return view('Admin::users.create');
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
            return redirect(route('admin.users.create'))->withErrors($e->getMessageBag())->withInput();
        }

        $formData = $request->all();

        $user = $this->user->create($formData);
        $user->assignRole($request->input('roles'));

        return redirect()->route('admin.users.edit', $user->id)->with('success', __('Thêm người dùng thành công!'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('Admin::users.show', compact('user'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roleQuery = Role::orderBy('name', 'asc');
        if(!auth()->user()->can('role-list')) {
            $roleQuery = $roleQuery->where('id', '<', '3');
        }
        $roles = $roleQuery->get();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('Admin::users.edit')->with('dataEdit', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        try {
            $this->validator->with($request->all())->setId($user->id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        } catch (ValidatorException $e) {
            return redirect(route('admin.users.edit', $user->id))->withErrors($e->getMessageBag())->withInput();
        }

        $formData = $request->all();
        $user->update($formData);

        $userRoles = $user->roles->pluck('name', 'name')->all();
        foreach ($userRoles as $value) {
            $user->removeRole($value);
        }

        $roles = Role::whereIn('id', $request->input('roles'))->pluck('name', 'id')->all();
        $user->assignRole($roles);

        return redirect()->route('admin.users.edit', $user->id)->with('success', __('Update successful!'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lock(User $user)
    {
        $user->status = STATUS_INACTIVE;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', __('Khóa Account thành công'));
    }

    public function unlock(User $user)
    {
        $user->status = STATUS_ACTIVE;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', __('Mở khóa Account thành công'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', __('Xóa thành công!'));
    }
}
