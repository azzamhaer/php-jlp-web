window.onscroll = function() {
    var searchFilter = document.getElementById("searchFilter");

    // Tambahkan class 'shadow' ketika halaman di-scroll lebih dari 0px
    if (window.scrollY > 0) {
        searchFilter.classList.add("shadow");
    } else {
        searchFilter.classList.remove("shadow");
    }
};
