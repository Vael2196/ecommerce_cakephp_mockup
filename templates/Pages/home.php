<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$identity = $this->request->getAttribute('identity');

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        ConnectionManager::get($name)->getDriver()->connect();
        // No exception means success
        $connected = true;
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
        if ($name === 'debug_kit') {
            $error = 'Try adding your current <b>top level domain</b> to the
                <a href="https://book.cakephp.org/debugkit/5/en/index.html#configuration" target="_blank">DebugKit.safeTld</a>
            config and reload.';
            if (!in_array('sqlite', \PDO::getAvailableDrivers())) {
                $error .= '<br />You need to install the PHP extension <code>pdo_sqlite</code> so DebugKit can work properly.';
            }
        }
    }

    return compact('connected', 'error');
};

//if (!Configure::read('debug')) :
//    throw new NotFoundException(
//        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
//    );
//endif;

?>

<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Crunchy Cravings</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="One page parallax responsive HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Bingo HTML Template v1.0">

    <!-- theme meta -->
    <meta name="theme-name" content="bingo" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <!-- CSS
    ================================================== -->
    <!-- Themefisher Icon font -->
    <link rel="stylesheet" href="plugins/themefisher-font/style.css">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <!-- Lightbox.min css -->
    <link rel="stylesheet" href="plugins/lightbox2/css/lightbox.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="plugins/animate/animate.css">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="body">

<!--
Start Preloader
==================================== -->
<div id="preloader">
    <div class='preloader'>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!--
End Preloader
==================================== -->


<!--
Fixed Navigation
==================================== -->
<header class="navigation fixed-top">
    <div class="container">
        <!-- main nav -->
        <nav class="navbar navbar-expand-lg navbar-light px-0" id="mainNav">
            <!-- logo -->
            <a class="navbar-brand logo" href="#mainNav">
                <img loading="lazy" class="logo-default logo-size" src="img/Crunchy-Cravings-3.png" width="200" height="auto" alt="logo" />
                <img loading="lazy" class="logo-white logo-size" src="img/Crunchy-Cravings-2.png" width="200" height="auto" alt="logo" />
            </a>
            <!-- /logo -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav ml-auto text-center">
                    <!-- Navigation options only for admin-->
                    <?php if ($identity && $identity->role == 1): ?>
                        <li class="nav-item"><?= $this->Html->link('Dashboard', ['controller' => 'Users', 'action' => 'dashboard'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link('Products', ['controller' => 'Products', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link('Messages', ['controller' => 'Messages', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link('Suppliers', ['controller' => 'Suppliers', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link('FAQ', ['controller' => 'Pages', 'action' => 'faq'], ['class' => 'nav-link']) ?></li>
                        <!--                        <li class="nav-item">--><?php //= $this->Html->link('Orders', ['controller' => 'Orders', 'action' => 'index'], ['class' => 'nav-link']) ?><!--</li>-->
                    <?php else: ?>
                        <li class="nav-item ">
                            <a class="nav-link" href="#AboutUs">About Us</a>
                        </li>
                        <li class="nav-item"><?= $this->Html->link('Shop', ['controller' => 'Pages', 'action' => 'shop'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link('FAQ', ['controller' => 'Pages', 'action' => 'faq'], ['class' => 'nav-link']) ?></li>
                        <li class="nav-item"><?= $this->Html->link('Contact Us', ['controller' => 'Messages', 'action' => 'contact'], ['class' => 'nav-link']) ?></li>

                    <?php endif; ?>

                    <!-- Navigation options only for logged in customers-->
                    <?php if ($identity): ?>
                        <?php if ($identity->role == 0): ?>
                            <li class="nav-item"><?= $this->Html->link('My Cart', ['controller' => 'Carts', 'action' => 'myCart'], ['class' => 'nav-link']) ?></li>
                        <?php endif; ?>
                        <li class="nav-item"><?= $this->Html->link('Log out', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link text-logout fw-bold']) ?></li>
                    <?php else: ?>
                        <li class="nav-item"><?= $this->Html->link('Log in', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?></li>
<!--                        <li class="nav-item">--><?php //= $this->Html->link('Register', ['controller' => 'Users', 'action' => 'register'], ['class' => 'nav-link']) ?><!--</li>-->
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <!-- /main nav -->
    </div>
</header>
<!--
End Fixed Navigation
==================================== -->

<div class="hero-slider">
    <div class="slider-item th-fullpage hero-area img-opacity" style="background-image: url(webroot/img/bg-masthead1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">Lavosh Crackers</h1>
                    <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">Discover the finest gourmet Middle Eastern crackers with CrunchyCravings.
                        <br> Explore our collection. </p>
<!--                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn btn-main"-->
<!--                       href="service.html">view products</a>-->
                    <?= $this->Html->link(
                        'View Products',
                        ['controller' => 'Pages', 'action' => 'shop'],
                        [
                            'class' => 'btn btn-main',
                            'data-duration-in' => '.3',
                            'data-animation-in' => 'fadeInUp',
                            'data-delay-in' => '.8'
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-item th-fullpage hero-area" style="background-image: url(webroot/img/bg-masthead2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".1">Luxury in every crunch</h1>
                    <p data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".5">Delicately crisp, boldly refined.
                        <br>Elevate every bite. </p>
                    <?= $this->Html->link(
                        'Get Crunchy',
                        ['controller' => 'Pages', 'action' => 'shop'],
                        [
                            'class' => 'btn btn-main',
                            'data-duration-in' => '.3',
                            'data-animation-in' => 'fadeInUp',
                            'data-delay-in' => '.8'
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="blog" id="WhatWeOffer">
    <div class="container">
        <div class="row justify-content-center">
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center ">
                    <h2> What We <span class="color">Offer</span></h2>
                    <div class="border"></div>
                    <p>We offer our handcrafted products for retail purchase and also cater to wholesale orders with flexible delivery options. </p>
                </div>
            </div>
            <!-- /section title -->
        </div>

        <div class="row">
            <!-- single blog post -->
            <article class="col-lg-4 col-md-6">
                <div class="post-item">
                    <div class="content">
                        <h3><a href="single-post.html">Premium Crackers</a></h3>
                        <p>Our range of premium artisan lavosh crackers is the heart of our offerings, crafted with care and tradition.</p>
                        <?= $this->Html->link('View Crackers', ['controller' => 'Pages', 'action' => 'shop'], ['class' => 'btn btn-main']) ?>
                    </div>
                </div>
            </article>
            <!-- /single blog post -->

            <!-- single blog post -->
            <article class="col-lg-4 col-md-6">
                <div class="post-item">
                    <div class="content">
                        <h3><a href="single-post.html">Hampers</a></h3>
                        <p>Discover our beautifully curated hampers. Perfect for gifts, celebrations, and special events. </p>
                        <?= $this->Html->link('View Hampers', ['controller' => 'Pages', 'action' => 'shop'], ['class' => 'btn btn-main']) ?>
                    </div>
                </div>
            </article>
            <!-- end single blog post -->

            <!-- single blog post -->
            <article class="col-lg-4 col-md-6">
                <div class="post-item">

                    <div class="content">
                        <h3><a href="single-post.html">Charcuterie Boards</a></h3>
                        <p>Find a selection of premium cheeses, cured meats and more to complement the crackers for a complete snacking experience.</p>
                        <?= $this->Html->link('View Boards', ['controller' => 'Pages', 'action' => 'shop'], ['class' => 'btn btn-main']) ?>
                    </div>
                </div>
            </article>
            <!-- end single blog post -->
        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end section -->

<!-- =============== About US Section ====================== -->
<section class="service-2 section aboutus-section"  id="AboutUs">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <!-- section title -->
                    <div class="title text-center">
                        <h2>About Us</h2>
                        <p> At CrunchyCravings, we are a family-owned business dedicated to crafting artisan lavosh crackers
                            that celebrate the rich heritage of Middle Eastern cuisine. Handcrafted with care and inspired
                            by generations of tradition, our crackers combine authenticity with a modern gourmet touch.
                            Every batch is a testament to quality, culture, and the simple joy of sharing something truly special.
                        </p>
                        <div class="border"></div>
                    </div>
                    <!-- /section title -->
                </div>
            </div>
        </div> <!-- End container -->
</section> <!-- End section -->

<!-- =============== WHY US Section ====================== -->
<section class="about-2 section" id="whyus">
    <div class="container">
        <div class="row justify-content-center">
            <!-- section title -->
            <div class="col-lg-6">
                <div class="title text-center">
                    <h2>Why CrunchyCravings?</h2>
                    <p>We make delicious lavosh crackers that are perfect for stores, cafes, and restaurants—easy to love, easy to serve.
                        Stock up today and give your customers something they’ll keep coming back for.</p>
                    <div class="border"></div>
                </div>
            </div>
            <!-- /section title -->
        </div>

        <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
                <img loading="lazy" src="img/charc_board.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-md-6">
                <ul class="checklist">
                    <li>&#10003; Perfect for cheese boards, dips, or on their own</li>
                    <br>
                    <li>&#10003; Available in bulk or retail-ready packs</li>
                    <br>
                    <li>&#10003; Ideal for cafés, restaurants, and gourmet grocers</li>
                    <br>
                    <li>&#10003; Shelf-stable and easy to store</li>
                    <br>
                    <li>&#10003; Great margins for wholesale partners</li>
                    <br>
                </ul>
                <div class="col-md-6">
                    <?= $this->Html->link('View Products', ['controller' => 'Pages', 'action' => 'shop'], ['class' => 'btn btn-main']) ?>
                </div>
            </div>

        </div> <!-- End row -->
    </div> <!-- End container -->
</section> <!-- End section -->


<footer id="footer" class="bg-one">
    <div class="top-footer">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                    <ul>
                        <li>
                            <h3>Our Store</h3>
<!--                        <li><a href="">A: 12944 Reichert Port, New Tyler, VT 82635</a></li>-->
<!--                        <li><a href="">T: 03 9999 9999</a></li>-->
                            <?php
                            $addressBlock = null;
                            $phoneBlock   = null;
                            foreach ($footerBlocks as $b) {
                                if ($b->label === 'Address') $addressBlock = $b;
                                if ($b->label === 'Phone') $phoneBlock = $b;
                            }
                            $address = h($addressBlock->value ?? '');
                            $phone = h($phoneBlock->value ?? '');
                            $addrId = $addressBlock->id ?? null;
                            $phoneId = $phoneBlock->id ?? null;
                            ?>

                            <ul>
                                <li id="footer-address-display"
                                    style="
                                      font-size: 0.9rem;
                                      color: #c39b6a;
                                      background-color: rgba(34,34,34);
                                      padding: 8px 12px;
                                      border-radius: 4px;
                                      margin-bottom: 4px;
                                    ">A: <?= $address ?></li>
                                <li id="footer-phone-display"
                                    style="
                                      font-size: 0.9rem;
                                      color: #c39b6a;
                                      background-color: rgba(34,34,34);
                                      padding: 8px 12px;
                                      border-radius: 4px;
                                      margin-bottom: 8px;
                                    ">P: <?= $phone ?></li>
                                <?php if ($identity && $identity->role == 1): ?>
                                    <li>
                                        <button
                                            id="footer-edit-toggle"
                                            class="btn btn-sm btn-outline-warning"
                                            style="font-size:1rem; padding: .5rem 1rem; margin-right: .5rem;"
                                        >Edit</button>
                                        <button
                                            id="footer-save"
                                            class="btn btn-sm btn-warning d-none"
                                            style="font-size:1rem; padding: .5rem 1rem;"
                                        >Save</button>
                                    </li>
                                <?php endif; ?>
                            </ul>
                    </ul>
                </div>
                <!-- End of .col-sm-3 -->

                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                    <ul>
                        <li>
                            <h3>Information</h3>
                        </li>
                        <li><a href="#AboutUs">About Us</a></li>
<!--                        <li><a href="#AboutUs">Reviews</a></li>-->
<!--                        <li><a href="#AboutUs">Returns & Refunds</a></li>-->
<!--                        <li><a href="#AboutUs">Terms & Conditions</a></li>-->
                </div>
                <!-- End of .col-sm-3 -->

<!--                <div class="col-lg-2 col-md-6 mb-5 mb-md-0">-->
<!--                    <ul>-->
<!--                        <li>-->
<!--                            <h3>...</h3>-->
<!--                        </li>-->
<!--                        <li>--><?php //= $this->Html->link('Contact Us', ['controller' => 'Messages', 'action' => 'contact'], ['class' => 'nav-link']) ?><!--</li>-->
<!--                        <li><a href="service.html">Services</a></li>-->
<!--                        <li><a href="blog.html">Blogs</a></li>-->
<!--                        <li><a href="404.html">404</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
                <!-- End of .col-sm-3 -->

                <div class="col-lg-3 col-md-6">
                    <ul>
                        <li>
                            <h3>Contact Us</h3>
                        </li>
                        <li><?= $this->Html->link('Send an enquiry', ['controller' => 'Messages', 'action' => 'contact'], ['class' => 'nav-link']) ?></li>
                        <li><?= $this->Html->link('FAQ', ['controller' => 'Pages', 'action' => 'faq'], ['class' => 'nav-link']) ?></li>
                    </ul>
                    </ul>
                </div>
                <!-- End of .col-sm-3 -->

            </div>
        </div> <!-- end container -->
    </div>
    <div class="footer-bottom">
        <h5>Created by JAVSS Solutions (Team076) 2025 &copy; </h5>
    </div>
</footer> <!-- end footer -->


<!--
    Essential Scripts
    =====================================-->
<!-- Main jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap4 -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- Parallax -->
<script src="plugins/parallax/jquery.parallax-1.1.3.js"></script>
<!-- lightbox -->
<script src="plugins/lightbox2/js/lightbox.min.js"></script>
<!-- Owl Carousel -->
<script src="plugins/slick/slick.min.js"></script>
<!-- filter -->
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Smooth Scroll js -->
<script src="plugins/smooth-scroll/smooth-scroll.min.js"></script>

<!-- Custom js -->
<script src="js/script.js"></script>

<script>
    const BASE = <?= json_encode($this->request->getAttribute('base')) ?>;
    const CSRF = <?= json_encode($this->request->getAttribute('csrfToken')) ?>;

    // a tiny helper that treats 404-on-delete as “already gone”
    function ajaxPost(url, data = {}) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': CSRF,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(res => {
                if (res.ok) return res.json();
                if (res.status === 404 && url.includes('/delete/')) return {};
                throw new Error(`HTTP ${res.status}`);
            });
    }

    $(function(){
        const addrId  = <?= json_encode($addrId) ?>;
        const phoneId = <?= json_encode($phoneId) ?>;

        $('#footer-edit-toggle').on('click', ()=> {
            // swap display → inputs
            $('#footer-address-display').replaceWith(
                `<li><input id="footer-address-input" class="form-control" value="${address = <?= json_encode($address) ?>}" /></li>`
            );
            $('#footer-phone-display').replaceWith(
                `<li><input id="footer-phone-input"  class="form-control" value="${phone   = <?= json_encode($phone) ?>}"   /></li>`
            );
            $('#footer-edit-toggle').addClass('d-none');
            $('#footer-save').removeClass('d-none');
        });

        $('#footer-save').on('click', ()=> {
            const newAddr  = $('#footer-address-input').val().trim();
            const newPhone = $('#footer-phone-input').val().trim();
            const calls = [];

            if (addrId) {
                calls.push(
                    ajaxPost(`${BASE}/content-blocks/edit/${addrId}.json`, { value: newAddr })
                );
            }
            if (phoneId) {
                calls.push(
                    ajaxPost(`${BASE}/content-blocks/edit/${phoneId}.json`, { value: newPhone })
                );
            }

            Promise.all(calls)
                .then(() => window.location.reload(true))
                .catch(() => alert('Error saving footer. Please try again.'));
        });
    });
</script>

</body>

</html>
