// recipe description toggle extended menu

function showInfo(obj) {
    let descr = obj.parentElement.getElementsByClassName("desc")[0];
    let styl = window.getComputedStyle(descr);

    if (styl.display == "none") {
        descr.style.display = "block";
        obj.style.transform = "rotate(-90deg)"
    }else{
        descr.style.display = "none";
        obj.style.transform = "rotate(90deg)"
    }
}

// href function for dish menus

function jshref(path) {
    window.location.href = "recipe_page.php?recipe_id=" + path
}


// filter

const whiteBox = document.getElementById("whitelistBox");
const forms = Array.from(document.getElementById("sidebar").getElementsByTagName("form"));
let recipes = Array.from(document.getElementById("menu").getElementsByClassName("dish"));

let boxes = [];
forms.forEach(function(item){
    boxes = boxes.concat(Array.from(item.getElementsByTagName("input")));
});


function toggleDisplay(name, val){
    recipes.forEach(function(item){
        if(item.classList.contains(name)){
            item.style.display = val;
        }
    });
}

function resetFilter(){
    whiteBox.checked = false;
    boxes.forEach(function(item){
        item.checked = false;
    });
    recipes.forEach(function(item){
        item.style.display = "block";
    });
}

function filter(){
    if(whiteBox.checked == false){
        recipes.forEach(function(item){
            item.style.display = "block";
        });
    }else{
        recipes.forEach(function(item){
            item.style.display = "none";
        });
    }

    boxes.forEach(function(item){
        if(whiteBox.checked == false){
            if(item.checked == true){
                toggleDisplay(item.id.replace("Box", ""), "none");
            };
        }else{
            if(item.checked == true){
                toggleDisplay(item.id.replace("Box", ""), "block");
            };
        };
    });
}

// sort

const reversedBox = document.getElementById("reversedBox");
const tempDiv = document.getElementById("temp");
const menu = document.getElementById("menu");

const pricesRef = {
    "lowPrice":1,
    "mediumPrice":2,
    "highPrice":3
}

const difficultyRef = {
    "lowDifficulty":1,
    "mediumDifficulty":2,
    "highDifficulty":3
}

function sortName(){
    let currentRecipes = Array.from(document.getElementsByClassName("dish"));

    currentRecipes.forEach(function(item){
        tempDiv.appendChild(item);
    });


    currentRecipes.sort(function(a, b){
        if(a.getElementsByTagName("h2")[0].innerHTML.toLowerCase() < b.getElementsByTagName("h2")[0].innerHTML.toLowerCase()){
            return -1;
        }
        if(a.getElementsByTagName("h2")[0].innerHTML.toLowerCase() > b.getElementsByTagName("h2")[0].innerHTML.toLowerCase()){
            return 1;
        }
        return 0
    });
    if(reversedBox.checked == true){
        currentRecipes.reverse();
    }


    currentRecipes.forEach(function(item){
        menu.appendChild(item);
    });
}

sortName()

function sortPrice(){
    let currentRecipes = Array.from(document.getElementsByClassName("dish"));

    currentRecipes.forEach(function(item){
        tempDiv.appendChild(item);
    });


    currentRecipes.sort(function(a, b){
        return pricesRef[a.classList[1]] - pricesRef[b.classList[1]];
    });
    if(reversedBox.checked == true){
        currentRecipes.reverse();
    }


    currentRecipes.forEach(function(item){
        menu.appendChild(item);
    });
}

function sortDifficulty(){
    let currentRecipes = Array.from(document.getElementsByClassName("dish"));

    currentRecipes.forEach(function(item){
        tempDiv.appendChild(item);
    });


    currentRecipes.sort(function(a, b){
        return difficultyRef[a.classList[2]] - difficultyRef[b.classList[2]];
    });
    if(reversedBox.checked == true){
        currentRecipes.reverse();
    }


    currentRecipes.forEach(function(item){
        menu.appendChild(item);
    });
}

    currentRecipes.forEach(function(item){
        menu.appendChild(item);
    });
}
