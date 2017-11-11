<?php

namespace App\Mail;

use App\Referral;

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
    public $referral;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Referral $referral)
    {
        $this->referral = $referral;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@blythedale.co.za')
                    blade template view
                    ->view('emails.referralAdded');



// To add attachments to an email, use the attach method within the mailable class' build method. The attach method accepts the full path to the file as its first argument:
                 // ->attach('/path/to/file', [
                 //     'as' => 'name.pdf',
                 //     'mime' => 'application/pdf',
                 // ]);
                 // 
                 
// The attachData method may be used to attach a raw string of bytes as an attachment. For example, you might use this method if you have generated a PDF in memory and want to attach it to the email without writing it to disk. 
                 // ->attachData($this->pdf, 'name.pdf', [
                 //        'mime' => 'application/pdf',
                 //    ]);

// If you would like to customize the format of your email's data before it is sent to the template, you may manually pass your data to the view via the with method. Typically, you will still pass data via the mailable class' constructor; however, you should set this data to protected or private properties so the data is not automatically made available to the template. Then, when calling the  with method, pass an array of data that you wish to make available to the template:
                    // ->with([
                    //     'firstName' => $this->referral->firstname,
                    //     'referralEmail' => $this->referralEmail->email,
                    // ]);
    }
}
