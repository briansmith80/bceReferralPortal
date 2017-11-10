<?php

namespace App\Mail;

// use App\Referral;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReferralAdded extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The order instance.
     *
     * @var Order
     */
    // public $referral;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct(Referral $referral)
    // {
    //     $this->referral = $referral;
    // }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@blythedale.co.za')
                    ->view('emails.referralAdded');
    }
}
