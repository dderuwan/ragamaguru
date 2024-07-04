
    document.addEventListener('DOMContentLoaded', function() {
        const productLinks = document.querySelectorAll('.product-link');

        productLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                const productContainer = this.closest('.menu-item');
                const productName = productContainer.querySelector('.product-name').textContent;
                const productPrice = productContainer.querySelector('.price').textContent.replace('Rs ', '');

                const url = new URL(window.location.origin + "/products");
                url.searchParams.set('name', productName.trim());
                url.searchParams.set('price', productPrice.trim());

                window.location.href = url.toString();
            });
        });
    });
