<?php

namespace App\Mail;

use App\User;
//use App\Http\Controllers\Auth\

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Registerwelcome extends Mailable
{
    use Queueable, SerializesModels;

   /**
     * The order instance.
     *
     * @var Order
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        //dd($user);
    }

    /**
     * Build the message.
          *
     * @return $this
     */
    public function build()
    {

         return $this->from('noreply@blythedale.co.za')
                    ->subject('Welcome to Blythedale Coastal Estate bcePortal')
                    ->view('emails.registerwelcome');
    }
}
