<?php

print_r($_GET);

$ClientID="AZ1OkJilVmP7caXB10wtTm-en1MToabhcgAoPjwI0DPHKn0Xbf2t9yT2eBUF9AxRuSCfFwqdNBgMlcid";
$Secret="EEa08A1cAz26XaL_prkscVuQJvTFdJE3yELr53-YmwzjIBWfJkkYks9r2MMZlVK78ZWMsk9nIyri3TLm";

$Login=curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($Login,CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($Login,CURLOPT_USERPWD,$ClientID.":". $Secret);
curl_setopt($Login,CURLOPT_POSTFIELDS,"grant_type=client_credentials");
$Respuesta= curl_exec($Login);

 $objRespuesta = json_decode($Respuesta);
 $AccessToken = $objRespuesta->access_token;
 print_r($AccessToken);

 $venta= curl_init("https://api.sandbox.paypal.com/v1/payments/payment/".$_GET['paymentID']);

 curl_setopt($venta, CURLOPT_HTTPHEADER,array("Content-Type: application/json","Authorization: Bearer".$AccessToken));

 $RespuestaVenta=curl_exec($venta);
 print_r($RespuestaVenta);

?>