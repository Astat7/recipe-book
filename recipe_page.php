<?php
require_once("SmartCookClient.php");

$htmlText = file_get_contents("recipe_page_template.html");

// data referances

$prices = array("Cheap", "Medium", "Expensive");
$difficulties = array("Easy", "Medium", "Hard");
$dishCategories = array("Breakfast", "Soup", "Main course", "Dessert", "Dinner");
$recipeCategories = array("Soup", "Meat", "Meat free","Dessert", "Sauce", "Pasta", "Salad", "Sweet food", "Drink");
$tolerances = array("Vegetarian", "Vegan", "Nuts", "Gluten", "Lactose", "Spicy", "Alcohol", "Sea food", "Mushrooms");

// api connection

try {
    $data = (new SmartCookClient)
        ->setRequestData(["recipe_id" => $_GET["recipe_id"]])
        ->sendRequest("recipe")
        ->getResponseData();
} catch (Exception $e) {
    echo $e->getMessage();
}

// turn int data into their string form

$data["data"]["price"] = $prices[$data["data"]["price"]-1];
$data["data"]["difficulty"] = $difficulties[$data["data"]["difficulty"]-1];
$data["data"]["country"] = strtoupper($data["data"]["country"]);

foreach ($data["data"]["dish_category"] as $key => $item) {
    $data["data"]["dish_category"][$key] = $dishCategories[$item-1];
}

foreach ($data["data"]["recipe_category"] as $key => $item) {
    $data["data"]["recipe_category"][$key] = $recipeCategories[$item-1];
}

foreach ($data["data"]["tolerance"] as $key => $item) {
    $data["data"]["tolerance"][$key] = $tolerances[$item-1];
}

// fill template

foreach ($data["data"] as $key => $value) {
    if ($key == "ingredient") {
        continue;
    } elseif (is_array($value)) {
        $arrVal = implode(", ", $value);
        $htmlText = str_replace('{'.$key.'}', $arrVal, $htmlText);
    } else {
        $htmlText = str_replace('{'.$key.'}', $value, $htmlText);
    }
}

// ingredients handled separatly

$ingredients = $data["data"]["ingredient"];
$ingredientText = "";

foreach ($ingredients as $ingredient) {
    $ingredientText .= "<div class='ingredient'><ul>
                            <li>Ingredient: ".$ingredient["name"]."</li>
                            <li>Quantity: ".$ingredient["quantity"].$ingredient["unit"]."</li>";
    if (!($ingredient["necessary"])) {
        $ingredientText .= "<li>Optional</li>";
    }
    if ($ingredient["comment"]) {
        $ingredientText .= "<li>".$ingredient["comment"]."</li>";
    }
    $ingredientText .= "</ul></div>";
}
$htmlText = str_replace("{ingredients}", $ingredientText, $htmlText);

echo $htmlText;
