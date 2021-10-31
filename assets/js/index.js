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

const dropdown = document.getElementsByClassName("dropdown");

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        const dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}