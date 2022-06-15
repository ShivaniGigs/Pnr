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

    function sendGupShupSMS($mobile, $message) {
        $request ="";
        $param["method"]= "sendMessage";
        $param["send_to"] = $mobile;
        $param["msg"] = $message;
        $param["userid"] = "2000203086";
        $param["password"] = "@sJxy44@";
        $param["v"] = "1.1";
        $param["msg_type"] = "TEXT";
        $param["auth_scheme"] = "PLAIN";
        foreach($param as $key=>$val) {
            $request.= $key."=".urlencode($val);
            $request.= "&";
        }
        $request = substr($request, 0, strlen($request)-1);
        $url = "https://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;
        return  makeHttpRequest($url, null, null, "GET");
        // print_r($response);
        
    }
}






?>