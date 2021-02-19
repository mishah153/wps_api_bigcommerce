
<?php

$main_url = "http://api.wps-inc.com/";

/* start for the live trunder store */  
//live
define("API_LIVE_KEY", "8wfr4rbxk8");
define("API_LIVE_CLIENT_ID", "d54jjedoqvruj52ffvjkz158vsljgmy");
define("API_LIVE_ACCESS_TOKEN", "1k7gppjw8kcqh7xa52u2g4vbk3ap188");
define("API_LIVE_AUTH_KEY", "XGXtenoqZOmoh23mf64EoMbenDNjmoX6BEfua8Kw");

//local
define("API_TEST_KEY", "8wfr4rbxk8");
define("API_TEST_CLIENT_ID", "d54jjedoqvruj52ffvjkz158vsljgmy");
define("API_TEST_ACCESS_TOKEN", "1k7gppjw8kcqh7xa52u2g4vbk3ap188");
define("API_TEST_AUTH_KEY", "XGXtenoqZOmoh23mf64EoMbenDNjmoX6BEfua8Kw");
/* start for the trunder store */




/* start for the demo store */ 
/*define("API_LIVE_KEY", "zr9wlndi4l");
define("API_LIVE_CLIENT_ID", "b7xze1oiv03j553npgtcbhyvylhweeh");
define("API_LIVE_ACCESS_TOKEN", "1c6w81ry189l95n6wbo4q7bbe3tx1rb");
define("API_LIVE_AUTH_KEY", "XGXtenoqZOmoh23mf64EoMbenDNjmoX6BEfua8Kw");

//local
define("API_TEST_KEY", "zr9wlndi4l");
define("API_TEST_CLIENT_ID", "b7xze1oiv03j553npgtcbhyvylhweeh");
define("API_TEST_ACCESS_TOKEN", "1c6w81ry189l95n6wbo4q7bbe3tx1rb");
define("API_TEST_AUTH_KEY", "XGXtenoqZOmoh23mf64EoMbenDNjmoX6BEfua8Kw");*/
/* end for the demo store */ 


//    $api_key = API_LIVE_KEY;
//    $client_id = API_LIVE_CLIENT_ID;
//    $access_token = API_LIVE_ACCESS_TOKEN;
//    $api_key = API_TEST_KEY;
//    $client_id = API_TEST_CLIENT_ID;
//    $access_token = API_TEST_ACCESS_TOKEN;
function getData($url) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . API_LIVE_AUTH_KEY
        ),
    ));

    $response = curl_exec($curl);
   
    curl_close($curl);
    return json_decode($response, true);
}

function createProduct($url, $method, $data) {
    $api_key = API_TEST_KEY;
    $client_id = API_TEST_CLIENT_ID;
    $access_token = API_TEST_ACCESS_TOKEN;
    $header = array(
        "accept: application/json",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 0bfdb5f3-c801-b125-9c8e-714f2b38a53e",
        "x-auth-client: " . $client_id,
        "x-auth-token: " . $access_token
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.bigcommerce.com/stores/$api_key/v3/$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "$method",
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => "$data",
        CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);
 
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
        return "empty";
    } else {
        $result = json_decode($response, true);
        if (isset($result['errors'])) {
            $r = $result['errors'];
        } else {
            $r = $result;
        }
    }
    return $r;
}

function createProductCategory($url, $method, $data) {
    $api_key = API_TEST_KEY;
    $client_id = API_TEST_CLIENT_ID;
    $access_token = API_TEST_ACCESS_TOKEN;
    $header = array(
        "accept: application/json",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 0bfdb5f3-c801-b125-9c8e-714f2b38a53e",
        "x-auth-client: " . $client_id,
        "x-auth-token: " . $access_token
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.bigcommerce.com/stores/$api_key/v3/$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "$method",
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => "$data",
        CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);
  
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
        return "empty";
    } else {
        $result = json_decode($response, true);
        if (isset($result['errors'])) {
            $r = $result['errors'];
        } else {
            $r = $result;
        }
    }
    return $r;
}


function createBrand($url, $method, $data) {
    $api_key = API_TEST_KEY;
    $client_id = API_TEST_CLIENT_ID;
    $access_token = API_TEST_ACCESS_TOKEN;
    $header = array(
        "accept: application/json",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 0bfdb5f3-c801-b125-9c8e-714f2b38a53e",
        "x-auth-client: " . $client_id,
        "x-auth-token: " . $access_token
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.bigcommerce.com/stores/$api_key/v3/$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "$method",
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => "$data",
        CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);
  
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
        return "empty";
    } else {
        $result = json_decode($response, true);
        if (isset($result['errors'])) {
            $r = $result['errors'];
        } else {
            $r = $result;
        }
    }
    return $r;
}



function createProductVariantOption($url, $method, $data) {
    $api_key = API_TEST_KEY;
    $client_id = API_TEST_CLIENT_ID;
    $access_token = API_TEST_ACCESS_TOKEN;

    $header = array(
        "accept: application/json",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 0bfdb5f3-c801-b125-9c8e-714f2b38a53e",
        "x-auth-client: " . $client_id,
        "x-auth-token: " . $access_token
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.bigcommerce.com/stores/$api_key/v3/$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "$method",
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => "$data",
        CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
        return "empty";
    } else {
        $result = json_decode($response, true);
        if (isset($result['errors'])) {
            $r = $result['errors'];
        } else {
            $r = $result;
        }
    }

    return $r;
}

function createProductVariant($url, $method, $data) {
    $api_key = API_TEST_KEY;
    $client_id = API_TEST_CLIENT_ID;
    $access_token = API_TEST_ACCESS_TOKEN;

    $header = array(
        "accept: application/json",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 0bfdb5f3-c801-b125-9c8e-714f2b38a53e",
        "x-auth-client: " . $client_id,
        "x-auth-token: " . $access_token
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.bigcommerce.com/stores/$api_key/v3/$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "$method",
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => "$data",
        CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
        return "empty";
    } else {
        $result = json_decode($response, true);
        if (isset($result['errors'])) {
            $r = $result['errors'];
        } else {
            $r = $result;
        }
    }

    return $r;
}

function deleteProduct($url, $method, $data) {
    $api_key = API_TEST_KEY;
    $client_id = API_TEST_CLIENT_ID;
    $access_token = API_TEST_ACCESS_TOKEN;

    $header = array(
        "accept: application/json",
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 0bfdb5f3-c801-b125-9c8e-714f2b38a53e",
        "x-auth-client: " . $client_id,
        "x-auth-token: " . $access_token
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.bigcommerce.com/stores/$api_key/v3/$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "$method",
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => "$data",
        CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
        return "empty";
    } else {
        $result = json_decode($response, true);
        if (isset($result['errors'])) {
            $r = $result['errors'];
        } else {
            $r = $result;
        }
    }
    return $r;
}

?>