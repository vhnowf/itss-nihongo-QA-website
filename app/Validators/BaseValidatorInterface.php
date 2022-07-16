<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;

interface BaseValidatorInterface extends ValidatorInterface
{
    const RULE_LOGIN = 'login';
    const RESET_PASSWORD = 'reset_password';
    const EDIT_PROFILE = 'edit_profile_user';
    const CHANGE_PASSWORD = 'change_password_user';
    const CHANGE_PASSWORD_ADMIN = 'change_password_admin';
}
