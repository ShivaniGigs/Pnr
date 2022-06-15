<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class OTPVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resendOTP(Request $request){
        $digits = 4;
        $otp =  rand(pow(10, $digits-1), pow(10, $digits)-1);
        $is_otpSend = OTPVerification::updateSendOtp($request->mobile,$otp);
        $message = "Hi, Your OTP for Dhandhar Gold is: ".$otp." Regards Gigs Fintech Pvt. Ltd.";
        //$message = "Hi, Your OTP for Rupeezo is: ".$otp." Regards Gigs Fintech Pvt. Ltd.";
        return  sendGupShupSMS($request->mobile, $message);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
