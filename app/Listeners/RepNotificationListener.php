<?php

namespace App\Listeners;

use App\Events\RepNotificationEvent;
use App\Mail\SendReviewEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use AfricasTalking\SDK\AfricasTalking;

class RepNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RepNotificationEvent $event): void
    {
        //
        $user=$event->user;
        $customer=$event->customer;

        //Send SMS
        $username = config('sms.sms_username');
        $apiKey   = config('sms.sms_key');

        $AT       = new AfricasTalking($username, $apiKey);
        $sms      = $AT->sms();
;
        $message='Hello ' .$user->name. ' A new detractor review has been submitted by a customer.
        See additional information below. \n
        Name: ' .$customer->name. '\n
        Email: ' .$customer->email. '\n
        Cellphone: ' .$customer->phone. '\n
        Average rating :' .number_format($customer->answers->average('value'),2);
        $result   = $sms->send([
            'to'      => $user->cellphone,
            'message' => $message,
            'from'=>'Company X'
        ]);

        //Send email
        Mail::to($user)->send(new SendReviewEmail($user,$customer));
    }
}
