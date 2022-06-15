<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Excceptions;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPassword;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website.sign_up');
    }
    public function loginPage()
    {
        return view('website.login');
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
            if(!is_null($user)){
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
     return view ('website.forgotpassform');
    }

    

    public function sendResetLink(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        dd( $user);
        if (!$user) {
            return back()->with('failed', 'Failed! email is not registered.');
        }


    }
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
