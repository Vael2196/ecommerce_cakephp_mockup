<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>


<section class="contact-form" id="login">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 100px;>
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
        <div class="title text-center">
            <h2>Shop</h2>
            <p>Explore all our CrunchyCraving crackers, hampers and charcuterie boards!</p>
            <div class="border"></div>
        </div>
    </div>
</section>

<section class="user-dashboard page-wrapper">
    <div class="container">
        <p>Filter by type</p>
        <div class="row">
            <div class="col-md-12">
                <?php
                $currentType = $this->request->getQuery('type'); // Get the current selected product type
                ?>

                <ul class="list-inline dashboard-menu text-center">
                    <li class="list-inline-item">
                        <button class="btn btn-dark filter-btn" data-type="All">All Products</button>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn btn-outline-secondary filter-btn" data-type="Crackers">Crackers</button>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn btn-outline-secondary filter-btn" data-type="Hampers">Hampers</button>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn btn-outline-secondary filter-btn" data-type="Boards">Charcuterie Boards</button>
                    </li>
                </ul>
                <div class="row justify-content-center mt-3" style="gap: 10px;">
                    <div class="form-inline">
                        <label for="sort-price" class="me-2 fw-bold" style="padding: 10px">Sort by: </label>
                        <select id="sort-price" class="form-control">
                            <option value="default">Price</option>
                            <option value="asc">Low to High</option>
                            <option value="desc">High to Low</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div>
        <!-- Product grids -->
        <?= $this->element('products_grid', ['products' => $products ?? null]) ?>
    </div>
</section>

<script>
    //Filtering buttons according to product type
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.filter-btn');
        const productCards = document.querySelectorAll('.product-card');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const selectedType = button.getAttribute('data-type'); //find type of each product

                // Toggle active button styles
                buttons.forEach(btn => {
                    btn.classList.remove('btn-dark', 'active');
                    btn.classList.add('btn-outline-secondary');
                });
                button.classList.remove('btn-outline-secondary');
                button.classList.add('btn-dark', 'active');

                // Show/hide product cards based on selected type
                productCards.forEach(card => {
                    const cardType = card.getAttribute('data-type');
                    if (selectedType === 'All' || cardType === selectedType) {
                        card.style.display = '';  // Show product
                    } else {
                        card.style.display = 'none';  // Hide product
                    }
                });
            });
        });
    });

    //Function for sorting price of products
    document.addEventListener('DOMContentLoaded', function () {
        const sortSelect = document.getElementById('sort-price');
        const productGrid = document.querySelector('.parent-product-card');

        sortSelect.addEventListener('change', function () {
            const sortOrder = this.value;
            const cards = Array.from(productGrid.querySelectorAll('.product-card'));

            if (sortOrder === 'default') {
                location.reload(); // reloads to original state
                return;
            }

            // rearranges cards
            cards.sort((a, b) => {
                const priceA = parseFloat(a.querySelector('.price').dataset.price);
                const priceB = parseFloat(b.querySelector('.price').dataset.price);

                return sortOrder === 'asc' ? priceA - priceB : priceB - priceA;
            });

            cards.forEach(card => productGrid.appendChild(card));
        });
    });
</script>
