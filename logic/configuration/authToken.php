<?php
require '../vendor/autoload.php';
$grantToken = "1000.85dbabbedb62af7034fc18c3839f5fe4.ba431941a0e494142730c11ff03a3093";
$client_id = "1000.ZX7V64RLO49D55521ME81JFXYE7KGM";
$cliente_secret = "986712d676ffc6ac5d6d69cdc1ccd03cbbe68d2e5d";
$redirect_url = "http://localhost/projects/Vision-form/";
$refresh_token = "1000.30b683f78af84a0372931765fb556c28.08260bb08ba3f4284d22a0e3815fd52b";
$curl_post_fields = "code=".$grantToken."&redirect_uri=".$redirect_url."&client_id=".$client_id."&client_secret=".$cliente_secret."&grant_type=authorization_code";
$curl_refresh = "refresh_token=".$refresh_token."&client_id=".$client_id."&client_secret=".$cliente_secret."&grant_type=refresh_token";
$curl_url = "https://accounts.zoho.com/oauth/v2/token?";
$curl_var = curl_init();
curl_setopt($curl_var, CURLOPT_URL, $curl_url);
curl_setopt($curl_var, CURLOPT_POSTFIELDS, $curl_refresh);
$response = curl_exec($curl_var);
print("\n".$response);
curl_close($curl_var);

if ($response == 1) {
    // try{
        ZCRMRestClient::initialize();
        $oAuthClient = ZohoOAuth::getClientInstance();
        $refreshToken = $refresh_token;
        $userIdentifier = "pbuiles@visiontecno.com";
        $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken,$userIdentifier);
}else {
    echo 'not conected';
}

