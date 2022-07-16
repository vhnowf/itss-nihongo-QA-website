<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class UserValidato.
 */
class AdminUserValidator extends LaravelValidator
{
    /**
     * FoodValidator constructor.
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
            BaseValidatorInterface::RULE_CREATE => [
                'fullname' => 'required|max:100',
                'email' => 'required|email|unique:users|max:100',
                'password' => 'required|min:6|max:191',
                // 'confirm_password' => 'required_with:password|same:password|min:6|max:191',
            ],
            BaseValidatorInterface::RULE_UPDATE => [
                'fullname' => 'required|max:100',
                'email' => 'required|email|unique:users,email,:id|max:100',
            ],
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'email' => __('email'),
            'password' => __('mật khẩu'),
            'old_password' => __('mật khẩu hiện tại'),
            'new_password' => __('mật khẩu mới'),
            'confirm_password' => __('xác nhận mật khẩu'),
            'fullname' => __('họ và tên'),
            'countrysite' => __('tên quốc gia'),
        ];

        /*
         *
         * Validator messages
         *
         */
        $this->messages = [
            'required' => __('Vui lòng nhập :attribute.'),
            'unique' => __(':attribute đã được sử dụng.'),
            'email' => __('Không phải địa chỉ email.'),
            'password.min' => __('Mật khẩu phải lớn hơn 6 ký tự.'),
            'confirm_password.min' => __('Mật khẩu phải lớn hơn 6 ký tự.'),
            'confirm_password.same' => __('Xác nhận mật khẩu không đúng.'),
            'required_with' => __('Vui lòng nhập :attribute.'),
            'integer' => __('Vui lòng nhập đúng định dạng số'),
            'max' => __('Sai định dang.'),
        ];
    }
}
