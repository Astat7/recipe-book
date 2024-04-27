<?php
require_once("SmartCookClient.php");

$htmlText = file_get_contents("recipe_page_template.html");

$prices = array(1=>"cheap", 2=>"medium", 3=>"expensive");
$difficulties = array(1=>"easy", 2=>"medium", 3=>"hard");

try {
    $data = (new SmartCookClient)
        ->setRequestData(["recipe_id" => $_GET["recipe_id"]])
        ->sendRequest("recipe")
        ->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}

$data["data"]["price"] = $prices[$data["data"]["price"]];
$data["data"]["difficulty"] = $difficulties[$data["data"]["difficulty"]];
$data["data"]["country"] = strtoupper($data["data"]["country"]);

foreach ($data["data"] as $key => $value) {
    if ($key == "ingredient") {
        $arrVal = [];
        foreach ($value as $ingredient) {
            array_push($arrVal, $ingredient["name"]);
        }
        $arrVal = implode(", ", $arrVal);
        $htmlText = str_replace('{'.$key.'}', $arrVal, $htmlText);
    } elseif (is_array($value)) {
        $arrVal = implode(", ", $value);
        $htmlText = str_replace('{'.$key.'}', $arrVal, $htmlText);
    } else {
        $htmlText = str_replace('{'.$key.'}', $value, $htmlText);
    }
}
echo $htmlText;
