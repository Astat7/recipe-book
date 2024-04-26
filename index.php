<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="catalog-styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Smart Cook</h1>
        <nav>
            <a href="recipe_page.php?recipe_id=1">Home</a>
            <a href="#">Contacts</a>
            <a href="#">Other</a>
        </nav>
    </header>
    <div id="sidebar">
        <div class="sidebarOptions">
            <label for="whitelistBox" class="sidebarInputs"><input type="checkbox" value="whitelist" name="whitelistOption" id="whitelistBox"> Switch to whitelist</label>
            <button class="sidebarInputs" onclick="resetFilter()">Reset filters</button>
            <button class="sidebarInputs" onclick="filter()">Filter menu</button>
        </div>
        <div class="sidebarOptions">
            <h3>Sort</h3>
            <label for="reversedBox" class="sidebarInputs sortInputs"><input type="checkbox" value="reversed" name="reversedOption" id="reversedBox"> Reverse order</label>
            <button class="sidebarInputs sortInputs" onclick="sortName()">Sort by name</button>
            <button class="sidebarInputs sortInputs" onclick="sortPrice()">Sort by price</button>
            <button class="sidebarInputs sortInputs" onclick="sortDifficulty()">Sort by difficulty</button>
        </div>

        <form>
            <h3>Price</h3>
            <label for="lowPriceBox"><input type="checkbox" id="lowPriceBox"> Low</label>
            <label for="medPriceBox"><input type="checkbox" id="medPriceBox"> Medium</label>
            <label for="highPriceBox"><input type="checkbox" id="highPriceBox"> High</label>
        </form>
        <form>
            <h3>Difficulty</h3>
            <label for="lowDifficultyBox"><input type="checkbox" id="lowDifficultyBox"> Low</label>
            <label for="medDifficultyBox"><input type="checkbox" id="medDifficultyBox"> Medium</label>
            <label for="highDifficultyBox"><input type="checkbox" id="highDifficultyBox"> High</label>
        </form>
        <form>
            <h3>Dish Category</h3>
            <label for="breakfastBox"><input type="checkbox" id="breakfastBox"> Breakfast</label>
            <label for="soupBox"><input type="checkbox" id="soupBox"> Soup</label>
            <label for="courseBox"><input type="checkbox" id="courseBox"> Main course</label>
            <label for="dessertBox"><input type="checkbox" id="dessertBox"> Dessert</label>
            <label for="dinnerBox"><input type="checkbox" id="dinnerBox"> Dinner</label>
        </form>
        <form>
            <h3>Recipe Category</h3>
            <label for="meatBox"><input type="checkbox" id="meatBox"> Meat</label>
            <label for="meatFreeBox"><input type="checkbox" id="meatFreeBox"> Meat free</label>
            <label for="sauceBox"><input type="checkbox" id="sauceBox"> Sauce</label>
            <label for="pastaBox"><input type="checkbox" id="pastaBox"> Pasta</label>
            <label for="saladBox"><input type="checkbox" id="saladBox"> Salad</label>
            <label for="sweetFoodBox"><input type="checkbox" id="sweetFoodBox"> Sweet food</label>
            <label for="drinkBox"><input type="checkbox" id="drinkBox"> Drink</label>
        </form>
        <form id="lastForm">
            <h3>Tolerance</h3>
            <label for="veganBox"><input type="checkbox" id="veganBox"> Vegan</label>
            <label for="vegetarianBox"><input type="checkbox" id="vegetarianBox"> Vegetarian</label>
            <label for="lactoseBox"><input type="checkbox" id="lactoseBox"> Lactose</label>
            <label for="glutenBox"><input type="checkbox" id="glutenBox"> Gluten</label>
            <label for="nutsBox"><input type="checkbox" id="nutsBox"> Nuts</label>
            <label for="seafoodBox"><input type="checkbox" id="seafoodBox"> Sea food</label>
            <label for="mushroomsBox"><input type="checkbox" id="mushroomsBox"> Mushrooms</label>
            <label for="alcoholBox"><input type="checkbox" id="alcoholBox"> Alcohol</label>
            <label for="spicyBox"><input type="checkbox" id="spicyBox"> Spicy</label>
        </form>
    </div>
    <div id="menu">

        <?php
        require_once("SmartCookClient.php");

        $levels = ["low", "med", "high"];

        $request_data = [
            "attributes" => ["id", "name", "author", "price", "difficulty"]
        ];

        try {
            $data = (new SmartCookClient)
                ->setRequestData($request_data)
                ->sendRequest("recipes")
                ->getResponseData();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        foreach ($data["data"] as $key => $value) {
            echo "<div class='dish ".$levels[$value["price"]-1]."Price ".$levels[$value["difficulty"]-1]."Difficulty"."' onclick='jshref(".$value["id"].")'>";
            echo "<h2>".ucfirst($value["name"])."</h2>";
            echo "<p>".ucfirst($levels[$value["price"]-1])." price, ".ucfirst($levels[$value["difficulty"]-1])." difficulty</p>";
            echo "</div>";
        }
        ?>

    </div>
    <div id="temp"></div>
    <script src="prog.js"></script>
</body>
</html>
