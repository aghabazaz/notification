<?php
namespace App\Services\Notification\Providers;
use App\Models\User;
use App\Services\Notification\Providers\Contracts\Provider;
use PhpParser\Node\Expr\Throw_;
use SoapClient;

class SmsProvider implements Provider
{
    private $user;
    private $text;
    public function __construct(User $user, String $text)
    {
        $this->user=$user;
        $this->text=$text;
    }

    public function send()
    {

       $this->havePhoneNumber();
        $sms_client = new SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding' => 'UTF-8'));
        try {
            $recId = array();
            $status = array();
            $parameters = array_merge(config('services.sms'), ['toNumbers' => [$this->user->phone_number], 'messageContent' => $this->text, 'isFlash' => false]);
            echo $sms_client->SendSMS($parameters)->SendSMSResult;
        } catch (Exception $e) {
            dd('Caught exception: ', $e->getMessage(), "\n");
        }
    }
    private function havePhoneNumber(){
        if(is_null($this->user->phone_number)){
            throw new \Exception("user does not have phone number");
        }
    }
}