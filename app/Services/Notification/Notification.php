<?php

namespace App\Services\Notification;
use App\Services\Notification\Providers\Contracts\Provider;
/**
 * @method sendSms(\App\User $user,String $text)
 * @method sendEmail(User $user,Mailable $mailable)
 */
class Notification
{
   /* public function sendEmail(User $user, Mailable $mailable)
    {
        $emailProvider = new EmailProvider();
        return $emailProvider->send($user, $mailable);
    }

    public function sendSms(User $user, String $text)
    {
        $smsProvider = new SmsProvider();
        return $smsProvider->send($user, $text);
    }*/
    public function __call($method,$argument){
        $providerPath=__NAMESPACE__ .'\Providers\\'.substr($method,4).'Provider';
        if(!class_exists($providerPath)){
            throw new \Exception("Class does not exit");
        }
        $providerInstance=new $providerPath(...$argument);
        if(!is_subclass_of($providerInstance,Provider::class)){
            throw new \Exception("class must implements \App\Services\Notification\Providers\Constracts\Provider");
        }
        //if $providerInstance sub class of provider
        return $providerInstance->send();
    }
}

