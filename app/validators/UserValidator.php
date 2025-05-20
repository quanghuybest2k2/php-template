<?php

namespace App\validators;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class UserValidator
{
    public static function validate(array $data): array
    {
        $errors = [];

        // Define validators with custom messages
        $validators = [
            'name' => v::notEmpty()->setTemplate('Họ tên không được để trống')
                ->length(3, 50)->setTemplate('Họ tên phải có độ dài từ 3 đến 50 ký tự')
                ->alpha(' ')->setTemplate('Họ tên chỉ được chứa chữ cái và khoảng trắng'),

            'email' => v::notEmpty()->setTemplate('Email không được để trống')
                ->email()->setTemplate('Email không hợp lệ'),

            'password' => v::notEmpty()->setTemplate('Mật khẩu không được để trống')
                ->length(6, 20)->setTemplate('Mật khẩu phải có độ dài từ 6 đến 20 ký tự'),
        ];

        foreach ($validators as $field => $validator) {
            try {
                $validator->assert($data[$field] ?? null);
            } catch (NestedValidationException $e) {
                $errors[$field] = $e->getMessages();
            }
        }

        return $errors;
    }
}
