<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id;
    public $users_to;
   
    public function __construct($id,$users_to)
    {
        $this->id = $id;
        $this->email = $users_to;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
      //  return view('websitePnrNumber.forgot_email');
        $id = $this->id;
        $email =  $this->email;
       
        //dd($user );
        return $this->from("riyaz@gigsfintech.com", $email)
        ->subject('Password Reset Link')
        ->view('websitePnrNumber.forgot_email',compact('id','email'));
    }
}
