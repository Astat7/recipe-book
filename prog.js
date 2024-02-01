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


// filter

const whiteBox = document.getElementById("whitelistBox");
const forms = Array.from(document.getElementById("sidebar").getElementsByTagName("form"));
const recipes = Array.from(document.getElementById("menu").getElementsByClassName("dish"));

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
