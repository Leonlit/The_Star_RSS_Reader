const navContainer = document.getElementById("nav_items_container");
let isNavOpen = false;
function open_close_nav() {
    if (!isNavOpen) {
        navContainer.style.top = "60px";
        isNavOpen = true;
    }else {
        navContainer.style.top = "-100%";
        isNavOpen = false;
    }
}