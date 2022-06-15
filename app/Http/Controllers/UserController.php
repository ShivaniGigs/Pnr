<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Support\Str;
use App\Excceptions;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('websitePnrNumber.sign_up');
    }
    public function loginPage()
    {
        return view('websitePnrNumber.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_create(Request $request){
  
        try {
            $email = $request->get('email');
            $mobile = $request->get('mobile');
            $check_mobile_and_email = User::where('email', $email)->orwhere('mobile', $mobile)->first();
           
            if(true ==  $check_mobile_and_email ){
              //  dd($check_mobile_and_email);
                return redirect()->back()->withInput()->withErrors(['errors' => 'Someting went wrong please try again.']);
            }
       $userStore = User::addUser($request);
     if(true == $userStore){
      echo "success";
     }else{
        return redirect()->back()->withInput()->withErrors(['errors' => 'Someting went wrong please try again.']);
     }
  
       } catch (Exception $e) {
           return redirect()->back()->withInput()->withErrors(['errors' => 'Someting went wrong please try again.']);
      } 
    }


    public function UserLogin(Request $request) {
     
        try {
            $validate= $this->validate($request, [
                'email'=>'required',
                'password' => 'required',
            ]);
        
            $user = User::GetUserDetailsForLogin($request);
           // dd($user);
            if(!is_null($user)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$user->id);
               echo "login";
                // return redirect()->back()->withInput()->withErrors(['errors' => 'success.']);
            }else{
                return redirect()->back()->withInput()->withErrors(['errors' => 'Invalid Credentials.']);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->withErrors(['errors' => 'Someting went wrong please try again.']);
        }
    }

  public function veryfiemail(Request $request) {
    $email = $request->get('email');
         $email = User::where('email', $email)->get();
            if (count($email) > 0) {
                return response()->json(['success' => false]);
            }else{
                return response()->json(['success' => true]);
            }

       return response()->json(['success' => true]);
 }

   public function veryfiecontact(Request $request) {
         $contact = User::where('mobile', $request->mobile)->get();

    if (count($contact) > 0) {
         return response()->json(['success' => false]);
     }else{
          return response()->json(['success' => true]);
             }

                return response()->json(['success' => true]);
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showForgotForm()
    {
     return view ('websitePnrNumber.forgotpassform');
    }

    

    public function sendResetLink(Request $request){
        try {
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        //dd( $user);
        if (!$user) {
            return back()->with('failed', 'Failed! email is not registered.');
        }
      
      
        \DB::table('users')->where(['email'=>$request->email])
                ->update(['email_verified_at'=>Carbon::now()]);
             
      
          $users_to = $request->email;
           $data = $user->id;
      
    
           Mail::to($users_to)->send(new ResetPassword($data,$users_to));
            return back()->with('success', 'We have e-mailed your password reset link!');
        if(Mail::failures() != 0) {
            return back()->with('success', 'Success! password reset link has been sent to your email');
        }
               

    } catch (Exception $e) {
       // dd($e);
        // Log::error($e->getMessage());
        return redirect()->back()->withInput()->withErrors(['errors' => 'Someting went wrong please try again.']);
    }

    }
    public function showResetForm(Request $request,$id){
           $user= User::where('id','=',$id)->first();
           $email= $user->email;
           $name= $user->name;
        return view('websitePnrNumber.resetpassword',compact('email','name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request){
     try{
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
        ]);

        $check_token = User::where([
            'email'=>$request->email
         ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid Email');
         }else{

            User::where('email', $request->email)->update([
                'password'=> base64_encode($request->password)
            ]);
            }

     } catch (Exception $e) {
            // dd($e);
             // Log::error($e->getMessage());
             return redirect()->back()->withInput()->withErrors(['errors' => 'Someting went wrong please try again.']);
            } 

   }
        
    
}
