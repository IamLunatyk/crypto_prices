<?php

error_reporting(E_ALL); ini_set('display_errors', 1);
function getCryptoPrices() {
    $ids = "bitcoin,ethereum,cardano,ripple,solana,atom,bnb,tron,dogecoin";
    $url = "https://api.coingecko.com/api/v3/simple/price?ids=$ids&vs_currencies=usd";

    $response = file_get_contents($url);
    $prices = json_decode($response, true);

    $result = [];

    foreach($prices as $crypto => $data) {
        $result[] = [
            "symbol" => strtoupper($crypto),
            "price" => number_format($data["usd"], 2)
         ];
    }
    return $result;
}

header("Content-type: application/json");
header("Access-Control-Allow-Origin: *");
echo json_encode(getCryptoPrices());

?>