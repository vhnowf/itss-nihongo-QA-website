<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class QuestionValidator.
 *
 * @package namespace App\Validators;
 */
class QuestionValidator extends LaravelValidator
{
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
                'title' => 'required',
                'content' => 'required',
            ],
            BaseValidatorInterface::RULE_UPDATE => [
                'title' => 'required',
                'content' => 'required'
            ],
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'title' => __('Title'),
            'content' => __('Content'),
        ];

        /*
         *
         * Validator messages
         *
         */
        $this->messages = [
            'required' => __('Vui lòng nhập :attribute.'),
        ];
    }
}
