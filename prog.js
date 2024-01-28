function showInfo(obj) {
    let descr = obj.parentElement.getElementsByClassName("desc")[0];
    let styl = window.getComputedStyle(descr);

    if (styl.visibility == "hidden") {
        descr.style.visibility = "visible";
    }else{
        descr.style.visibility = "hidden";
    }
}
