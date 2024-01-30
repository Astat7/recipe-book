// recipe description toggle extended menu

function showInfo(obj) {
    let descr = obj.parentElement.getElementsByClassName("desc")[0];
    let styl = window.getComputedStyle(descr);

    if (styl.display == "none") {
        descr.style.display = "initial";
    }else{
        descr.style.display = "none";
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
        console.log(item)
        if(item.classList.contains(name)){
            item.style.display = val;
        }
    });
}

function filter(){
    boxes.forEach(function(item){
        if(whiteBox.checked == false){
            if(item.checked == true){
                toggleDisplay(item.id.replace("Box", ""), "none");
            }else{
                toggleDisplay(item.id.replace("Box", ""), "block");
            };
        }else{
            if(item.checked == false){
                toggleDisplay(item.id.replace("Box", ""), "none");
            }else{
                toggleDisplay(item.id.replace("Box", ""), "block");
            };
        };
    });
}
