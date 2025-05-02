

document.addEventListener("DOMContentLoaded", function () {
    // Select the "ABOUT" menu item and dropdown
    let aboutMenu = document.querySelector(".menu ul li:nth-child(2) > a");
    let dropdown = document.querySelector(".dropdown");

    // Toggle dropdown on click
    aboutMenu.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent page from jumping
        dropdown.classList.toggle("show"); // Toggle dropdown visibility
    });

    // Close dropdown if clicked outside
    document.addEventListener("click", function (event) {
        if (!aboutMenu.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove("show");
        }
    });

    // Smooth scrolling effect for links (optional)
    let links = document.querySelectorAll("a[href^='#']");
    links.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            let targetId = this.getAttribute("href").substring(1);
            let targetSection = document.getElementById(targetId);
            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop - 50,
                    behavior: "smooth"
                });
            }
        });
    });
});

