<?php

namespace App\Services\Notification\Constants;

use App\Mail\ForgetPassword;
use App\Mail\TopicCreated;
use App\Mail\UserRegistered;

/**
 * Created by PhpStorm.
 * User: ACER
 * Date: 3/25/2021
 * Time: 11:15 PM
 */
class EmailTypes
{
    const USER_REGISTERED = 1;
    const TOPIC_CREATED = 2;
    const FORGET_PASSWORD = 3;

    public static function toString()
    {
        return [
            self::USER_REGISTERED => "ثبت نام کاربر",
            self::TOPIC_CREATED => "ایجاد مقاله جدید",
            self::FORGET_PASSWORD => "فراموشی رمز عبور"
        ];
    }

    public static function toMail($type)
    {
        try {
            return [
                self::USER_REGISTERED => UserRegistered::class,
                self::TOPIC_CREATED => TopicCreated::class,
                self::FORGET_PASSWORD => ForgetPassword::class
            ][$type];
        } catch (\Throwable $th) {
                throw new \InvalidArgumentException('Mailable class does not exist');
        }
    }
}