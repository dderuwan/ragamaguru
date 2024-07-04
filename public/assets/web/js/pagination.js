// pagination JS

    document.addEventListener("DOMContentLoaded", function() {
    const itemsPerPage = 6;
    let currentPage = 1;

    const products = document.querySelectorAll("#product-list .menu-item");
    const totalPages = Math.ceil(products.length / itemsPerPage);

    function showPage(page) {
        products.forEach((item, index) => {
            if (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
        updatePagination(page);
    }

    function updatePagination(currentPage) {
        const paginationItems = document.querySelectorAll("#pagination .page-item");

        paginationItems.forEach(item => {
            item.classList.remove("active");
        });

        paginationItems[currentPage].classList.add("active");
    }

    // Click event listeners for pagination links
    document.querySelectorAll("#pagination .page-link").forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            currentPage = parseInt(this.getAttribute("data-page"));
            showPage(currentPage);
        });
    });

    // Previous page button
    document.getElementById("prevPage").addEventListener("click", function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    // Next page button
    document.getElementById("nextPage").addEventListener("click", function(e) {
        e.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // Initial page load
    showPage(currentPage);
});


 