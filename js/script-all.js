// JS FUNCTIONS COMMON TO BOTH PAGES

// function is called when window is scrolled
window.onscroll = function() {
    stickyNav()
};

// function to stick nav on top of page
function stickyNav() {
    let nav = document.getElementById("nav");
    let sticky = nav.offsetTop;
    if (window.pageYOffset > sticky) {
        // scrolling down
        nav.classList.add("sticky-nav");
    } else {
        // reached top
        nav.classList.remove("sticky-nav");
    }
}