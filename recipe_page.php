<?php
require_once("SmartCookClient.php");

try {
    (new SmartCookClient)
        ->setRequestData(["recipe_id" => $_GET["recipe_id"]])
        ->sendRequest("recipe")
        ->printResponse();
} catch (Exception $e) {
    echo $e->getMessage();
}
