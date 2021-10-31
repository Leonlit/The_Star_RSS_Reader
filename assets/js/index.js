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
    dropdown[i].addEventListener("click", function(event) {
        const dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
        let id = "" + event.target.id;
        console.log(typeof(id));
        id = id.split("-")[1];
        console.log(id);
        remove_other_dropdown_content_view(id);
    });
}

function remove_other_dropdown_content_view(exceptionEle) {
    const dropdownContent = document.getElementsByClassName("dropdown_content");
    for (i = 0; i < dropdownContent.length; i++) {
        console.log(exceptionEle, i);
        if (i == exceptionEle) {
            continue
        }else {
            dropdownContent[i].style.display = "none";
        }
    }
}