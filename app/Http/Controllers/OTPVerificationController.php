<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\OTPVerification;

class OTPVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function resendOTP(Request $request){
    //     $digits = 4;
    //     $otp =  rand(pow(10, $digits-1), pow(10, $digits)-1);
    //     $is_otpSend = OTPVerification::updateSendOtp($request->mobile,$otp);
    //     $message = "Hi, Your OTP for Dhandhar Gold is: ".$otp." Regards Gigs Fintech Pvt. Ltd.";
    //     //$message = "Hi, Your OTP for Rupeezo is: ".$otp." Regards Gigs Fintech Pvt. Ltd.";
    //     return  sendGupShupSMS($request->mobile, $message);
        
    // }

    public function verify_otp(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|min:10',
            'otp' => 'required|min:4',
        ]);
        // dd($validator->errors(), $request->all());
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ],500);
        }

        $otp = array();
        //    return $request;
        $otp[0] = $request->confirm_otp_popup_number_1;
        $otp[1] = $request->confirm_otp_popup_number_2;
        $otp[2] = $request->confirm_otp_popup_number_3;
        $otp[3] = $request->confirm_otp_popup_number_4;
        $otp = implode("",$otp);
        $otpVerification = OTPVerification::where(['contact_type' => 1, 'mobile' => $request->mobile, 'otp' => $otp])->first();
        if (!$otpVerification) {
            return response()->json([
                'message' => 'Invalid OTP!',
            ], 422);
        } else {
            $otpVerification->otp = null;
            $otpVerification->save();
            $user = User::where('mobile', $request->mobile)->first();
            if (!$user) {
                $user = User::create([
                    'mobile' => $request->mobile,
                  
                ]);
            } 
           
            return response()->json([
                'message' => 'OTP Verified.',
            ], 200);
           
        }
     
    }
    public function resend_otp(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'mobile' => 'required|min:10',
          
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 400);
        }
        $otpVerification = OTPVerification::where(['contact_type' => 1, 'mobile' => $request->mobile])->first();
        $otp = (in_array(env('APP_ENV'), ['local', 'dev'])) ? '0000' : rand(1000, 9999);
        if (!$otpVerification) {
            $otpVerification = new OTPVerification();
        }
        $web = 1;
        $otpVerification->contact_type = $web;
        $otpVerification->mobile = $input['mobile'];
        $otpVerification->otp = $otp;
        $otpVerification->save();
        // dd($otpVerification);
        if(!in_array(env('APP_ENV'), ['local', 'dev'])){
            $message = "Hi, Your OTP for Instant Kred is: ".$otp."  Regards Gigs Fintech Pvt. Ltd.";
            $response = sendGupShupSMS($input['mobile'], $message);
        } else {
            $response['response'] = 'success';
        }
        $data['otp_status'] = ($response['response'] == 'success') ? true : false ;//sendOtp($input['mobile'], $otp);
        $data['mobile'] = $input['mobile'];
        // $data['response'] = json_encode($response);
        return response()->json([
            'data' => $data,
            'message' => ($data['otp_status']) ? 'OTP Sent' : 'Something went wrong. Please Try again.',
        ], 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function getCityByPincode(Request $request)
    {
      
        $request->validate([
            'pincode' => 'required'
        ]);

        // $url = "https://nominatim.openstreetmap.org/search.php?q=".$request->pincode."&countrycodes=in&format=jsonv2";

        // $url = "https://nominatim.openstreetmap.org/?format=json&addressdetails=1&postalcode=".$request->pincode."&countrycodes=in";

        $url = "http://www.postalpincode.in/api/pincode/".$request->pincode;
       

        try {
            $response = makeHttpRequest($url, [], null, 'GET');
        } catch (\Exception $exception){
            return response()->json([
                'status' => false,
                'data' => $exception->getMessage()
            ]);
        }

      

        if (false == ($response['http_code'] == 200)) {
            return response()->json([
                'status' => false,
                'data' => 'API not working'
            ],$response['http_code']);
        }

        $data = json_decode($response['response']);

        if($data->Status == "Error"){
            return response()->json([
                'status' => false,
                'data' => $data->Message
            ]);
        }

        $first_post_office = $data->PostOffice[0];

        return response()->json([
            'status' => true,
            'city_name' => $first_post_office->District,
            'state_name' => $first_post_office->State
        ]);
    }
}
