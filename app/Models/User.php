<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function addUser($data){
      
        try {
            $user = User::where('mobile', $request->mobile)->first();
            $user = new User();
            $user->name = $data->name;
            $user->mobile = $data->mobile;
            $user->email = $data->email;
            $user->pincode = $data->pincode;
            $user->city = $data->city;
            $user->address = $data->city . ", " . $data->pincode . ", " . $data->state;
            $user->password = base64_encode($data->password);
            $user->save();
            return $user;
        } catch (Exception $e) {
          
           // dd($e->getMessage);
            Log::error($e->getMessage);
            return 0;
        }
    

    }

   public  static function GetUserDetailsForLogin($data) {
   
        try {
            $password = base64_encode($data->password);
         
            $user = User::where(['email' => $data->email])->where(['password'=>$password])->first();
          
            return $user;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return 0;
        }
    }
}
