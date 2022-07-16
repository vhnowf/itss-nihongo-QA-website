<?php

namespace App\Validators;

use Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;

/**
 * Class AdminValidator.
 */
class AdminValidator extends LaravelValidator
{
    /**
     * AdminValidator constructor.
     *
     * @param Factory $validator
     */
    public function __construct(Factory $validator)
    {
        parent::__construct($validator);

        /*
         *
         * Validator rules
         *
         */
        $this->rules = [
            BaseValidatorInterface::RULE_LOGIN => [
                'email' => 'required|email',
                'password' => 'required',
            ],
            BaseValidatorInterface::RULE_CREATE => [
                'username' => 'required|max:100|unique:admins',
                'email' => 'required|email|max:100|unique:admins',
                'roles' => 'required',
                'password' => 'required',
            ],
            BaseValidatorInterface::RULE_UPDATE => [
                'username' => 'required|max:100|unique:admins,username,:id',
                'email' => 'required|email|max:100|unique:admins,email,:id',
                'roles' => 'required',
            ],
            BaseValidatorInterface::CHANGE_PASSWORD_ADMIN => [
                'oldpassword' => 'required',
                'password' => 'required|min:6',
                'confirmpassword' =>'required|required_with:password|same:password|min:6',

            ],
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'username' => __('tên đăng nhập'),
            'email' => __('email'),
            'password' => __('mật khẩu'),
            'password' => __('mật khẩu'),
            'confirmpassword' => __('xác nhận mật khẩu'),
            'oldpassword' => __('mật khẩu cũ'),
        ];

        /*
         *
         * Validator messages
         *
         */
        $this->messages = [
            'required' => __('Vui lòng nhập :attribute.'),
            'roles.required' => __('Vui lòng chọn :attribute.'),
            'email.email' => __('Sai định dạng email.'),
            'password.min' => __('Mật khẩu phải lớn hơn 6 ký tự.'),
            'confirmpassword.min' => __('Mật khẩu phải lớn hơn 6 ký tự.'),
            'confirmpassword.same' => __('Xác nhận mật khẩu không đúng.'),
            'required_with' => __('Vui lòng nhập :attribute.'),
        ];
    }
}
