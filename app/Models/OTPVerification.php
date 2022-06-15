<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTPVerification extends Model
{
    use HasFactory;
    protected $table = 'otp_verifications';
    protected $fillable = ['contact_type', 'mobile', 'otp','valid_till'];



    public static function updateSendOtp($mobile,$otp){
        $otp = OTPVerification::where('mobile',$mobile)->first();
        $otp->otp = $otp;
       return $otp->save();
      }
}
