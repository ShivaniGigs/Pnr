<?php 



    function pnrResponse($responseMsg,$responsedata,$serverReponseCode){
        return response()->json([
            "message"=>$responseMsg,
            "data"=>$responsedata
            ],$serverReponseCode);
    }

   function pnrResponseError($responseMsg,$serverReponseCode){
        return response()->json([
            "message"=>$responseMsg
            ],$serverReponseCode);
    }

 function makeHttpRequest($url, $params, $token = null, $method = "POST", $headers = ["Content-Type: application/json"])
{
    if ($token) {
        foreach ($token as $record) {
            $headers[] = $record;
        }
    }
    $serviceUrl = $url;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $serviceUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLINFO_HEADER_OUT => 1,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => ($method === 'POST') ? http_build_query($params) : null,
        CURLOPT_HTTPHEADER => ['accept: application/json', 'Content-Type: application/x-www-form-urlencoded']
    ));
    $response = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);
    // dd($response, $info, $params, $token, json_encode($params), $method);
    if (!empty($info['http_code'])) {
        $res = [];
        $res['response'] = $response;
        $res['http_code'] = (!empty($info['http_code'])) ? $info['http_code'] : null;
        return $res;
    } else {
        // throw new \Exception("Service not available!");
        return [
            'http_code' => 0,
            'status' => 500,
            'message' => 'Service not available! Please try again',
            'data' => null
        ];
    }

    // function sendGupShupSMS($mobile, $message) {
    //     $request ="";
    //     $param["method"]= "sendMessage";
    //     $param["send_to"] = $mobile;
    //     $param["msg"] = $message;
    //     $param["userid"] = "2000203086";
    //     $param["password"] = "@sJxy44@";
    //     $param["v"] = "1.1";
    //     $param["msg_type"] = "TEXT";
    //     $param["auth_scheme"] = "PLAIN";
    //     foreach($param as $key=>$val) {
    //         $request.= $key."=".urlencode($val);
    //         $request.= "&";
    //     }
    //     $request = substr($request, 0, strlen($request)-1);
    //     $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;
    //     return  makeHttpRequest($url, null, null, "GET");
    //     // print_r($response);
        
    // }
}



function sendGupShupSMS($mobile, $message, $type = 'OTP', $timestamp = '') {
    if (!in_array(config('app.env'), ['prod'])) {
        return  false;   /* response()->json([]); */
    }
    $request ="";
    $param["method"]= "sendMessage";
    $param["send_to"] = $mobile;
    $param["msg"] = $message;
    if($type=='OTP'){
        $param["userid"] = "2000203086";
        $param["password"] = "@sJxy44@";
    }else{
        $param["userid"] = "2000205008";
        $param["password"] = "Gigsgupshup@2022";
        if($timestamp !== ''){
            $param["timestamp"] = $timestamp;
        }
    }
    $param["v"] = "1.1";
    $param["msg_type"] = "TEXT";
    $param["auth_scheme"] = "PLAIN";
    foreach($param as $key=>$val) {
        $request.= $key."=".urlencode($val);
        $request.= "&";
    }
    $request = substr($request, 0, strlen($request)-1);
    $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;
    $response = makeHttpRequest($url, null, null, "GET");
    return $response;
}

function sendOtp($mobile, $otp)
{
    // return oneXTelSendOtp($mobile, $otp);
    return bulkSmsSendOtp($mobile, $otp);
}

function bulkSmsSendOtp($mobile, $otp)
{
    if (in_array(env('APP_ENV'), ['prod',])) {
        $message = "# Your OTP for Rupeezo is: {$otp} Regards Gigs Media Pvt. Ltd";
        $message = str_replace('+', '%20', urlencode($message));
        $apiKey = '41cc0045-5c7c-4646-9d10-c89e822221e9';
        $smsHeader = 'RUPEZO';
        $mobile = '91' . $mobile;
        $url = 'http://www.bulksmsapps.com/api/apismsv2.aspx?apikey=' . $apiKey . '&sender=' . $smsHeader . '&number=' . $mobile . '&message=' . $message;
        $res = makeHttpRequest($url, null, null, 'GET');
        if ($res['http_code'] == 200) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}



?>