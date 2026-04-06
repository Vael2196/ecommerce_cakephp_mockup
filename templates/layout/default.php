<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CrunchyCravings';
$identity = $this->request->getAttribute('identity');
?>
<html lang="en">
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <title>CrunchyCravings - <?= $this->fetch('title') ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $this->Url->build('/favicon.ico') ?>">
<!--    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">-->


<!-- Mobile Specific Metas
================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="One page parallax responsive HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Bingo HTML Template v1.0">

    <!-- theme meta -->
    <meta name="theme-name" content="bingo" />

    <!-- CSS
    ================================================== -->

    <?= $this->Html->css('style.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <!-- Themefisher Icon font -->
    <link rel="stylesheet" href="plugins/themefisher-font/style.css">
    <!-- bootstrap.min css -->
<!--    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <!-- Lightbox.min css -->
    <link rel="stylesheet" href="plugins/lightbox2/css/lightbox.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="plugins/animate/animate.css">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">



    <!-- Main Stylesheet -->
<!--    <link rel="stylesheet" href="css/style.css">-->


<header class="navigation fixed-top solid-navbar">
    <div class="container px-4 px-lg-5">
        <!-- main nav -->
        <nav class="navbar navbar-expand-lg navbar-light px-0" id="mainNav">
            <?php
            $user = $this->request->getAttribute('identity');
            $isAdmin = $user && $user->role == 1; // Assuming role 1 is admin
            ?>

            <a class="navbar-brand" href="<?= $this->Url->build('/') ?>">
                <?= $this->Html->image('Crunchy-Cravings-3.png', ['alt' => 'Logo', 'class' => 'navbar-brand.img', 'width' => '200px', 'height' => 'auto']) ?>
            </a>

<!--            --><?php //if (!$isAdmin): ?>
<!--                 Logo click leads to HOMEPAGE -->
<!--                <a class="navbar-brand" href="--><?php //= $this->Url->build('/') ?><!--">-->
<!--                    --><?php //= $this->Html->image('Crunchy-Cravings-3.png', ['alt' => 'Logo', 'class' => 'navbar-brand.img', 'width' => '200px', 'height' => 'auto']) ?>
<!--                </a>-->
<!--            --><?php //else: ?>
<!--                <If admin, clicking on logo leads to DASHBOARD page -->
<!--                <div class="navbar-brand">-->
<!--                    --><?php //= $this->Html->link($this->Html->image('Crunchy-Cravings-3.png', ['alt' => 'Logo', 'class' => 'navbar-brand.img', 'width' => '200px', 'height' => 'auto']),
//                        ['controller' => 'Users', 'action' => 'dashboard'],
//                        ['escape' => false]) ?>
<!--                </div>-->
<!--            --><?php //endif; ?>

            <!-- logo -->
<!--            <a class="navbar-brand" href="--><?php //= $this->Url->build('/') ?><!--">-->
<!--                --><?php //= $this->Html->image('Crunchy-Cravings-3.png', ['alt' => 'Logo', 'class' => 'navbar-brand.img', 'width' => '200px', 'height' => 'auto']) ?>
<!--            </a>-->

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav ml-auto text-center nav-options-colour">
                    <!-- Navigation options only for admin-->
                    <?php if ($identity && $identity->role == 1): ?>
                        <li class="nav-item"><?= $this->Html->link('Dashboard', ['controller' => 'Users', 'action' => 'dashboard'], ['class' => 'nav-link2']) ?></li>
<!--                        <li class="nav-item">--><?php //= $this->Html->link('Products', ['controller' => 'Products', 'action' => 'index'], ['class' => 'nav-link']) ?><!--</li>-->
<!--                        <li class="nav-item">--><?php //= $this->Html->link('Messages', ['controller' => 'Messages', 'action' => 'index'], ['class' => 'nav-link']) ?><!--</li>-->
<!--                        <li class="nav-item">--><?php //= $this->Html->link('Suppliers', ['controller' => 'Suppliers', 'action' => 'index'], ['class' => 'nav-link']) ?><!--</li>-->
<!--                        <li class="nav-item">--><?php //= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?><!--</li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link2 dropdown-toggle" href="#!" id="navbarDropdown02" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Inventory <i class="fas fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown02">
                                <li class="nav-item"><?= $this->Html->link('Products', ['controller' => 'Products', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                                <li class="nav-item"><?= $this->Html->link('Suppliers', ['controller' => 'Suppliers', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link2 dropdown-toggle" href="#!" id="navbarDropdown02" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                User Management <i class="fas fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown02">
                                <li class="nav-item"><?= $this->Html->link('Messages', ['controller' => 'Messages', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                                <li class="nav-item"><?= $this->Html->link('User Accounts', ['controller' => 'Users', 'action' => 'index'], ['class' => 'dropdown-item']) ?></li>
                            </ul>
                        </li>
<!--                        <li class="nav-item">Welcome, --><?php //= h($user->username) ?><!-- (Admin)</li>-->
                        <!--                        <li class="nav-item">--><?php //= $this->Html->link('Orders', ['controller' => 'Orders', 'action' => 'index'], ['class' => 'nav-link']) ?><!--</li>-->

                    <?php else: ?>
                        <li class="nav-item"><?= $this->Html->link('Shop', ['controller' => 'Pages', 'action' => 'shop'], ['class' => 'nav-link2']) ?></li>
                        <li class="nav-item"><?= $this->Html->link('FAQ', ['controller' => 'Pages', 'action' => 'faq'], ['class' => 'nav-link2']) ?></li>
                        <li class="nav-item"><?= $this->Html->link('Contact Us', ['controller' => 'Messages', 'action' => 'contact'], ['class' => 'nav-link2']) ?></li>
                        <?php if ($identity): ?>
                            <li class="nav-item"><?= $this->Html->link('My Cart', ['controller' => 'Carts', 'action' => 'myCart'], ['class' => 'nav-link2']) ?></li>
                        <?php endif; ?>

                    <?php endif; ?>

                    <!-- Navigation options only for logged in customers-->
                    <?php if ($identity): ?>
                        <li class="nav-item"><?= $this->Html->link('Log out', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link2 logout-text']) ?></li>
                    <?php else: ?>
                        <li class="nav-item"><?= $this->Html->link('Log in', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link2']) ?></li>
<!--                        <li class="nav-item">--><?php //= $this->Html->link('Register', ['controller' => 'Users', 'action' => 'register'], ['class' => 'nav-link2']) ?><!--</li>-->
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
    <div style="height: 80px;" class="bg-color"></div>

    <!-- ALL OTHER TEMPLATE FILE PAGES -->
<section class="bg-color" id="">
    <div class="container text-center px-lg-5 py-lg-0 bg-color">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content')  ?>

        <div style="height: 100px;" class="bg-color"></div>
    </div>

</section>
    <!-- END all other template file pages -->


    <?php $controller = $this->request->getParam('controller');
            $action = $this->request->getParam('action');
    $hideFooter = (
        ($controller === 'Users' && in_array($action, ['login', 'register','index','add','edit','view','dashboard']))
        || ($controller === 'Products' && in_array($action, ['index','add','edit','view']))
        || ($controller === 'Suppliers' && in_array($action, ['index','add','edit','view']))
        || ($controller === 'Messages' && in_array($action, ['index','add','edit','view']))
    );

    // Only show the footer if NOT on the login/register page or any admin pages
    if (!$hideFooter):
    ?>
        <!-- footer -->
        <footer id="footer" class="bg-one">
            <div class="top-footer">
                <div class="container">
                    <div class="row justify-content-around">
                        <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                            <ul>
                                <li>
                                    <h3>Our Store</h3>
<!--                                <li><a href="">A: 12944 Reichert Port, New Tyler, VT 82635</a></li>-->
<!--                                <li><a href="">T: 03 9999 9999</a></li>-->
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
                                        <?php if ($identity && $identity->role == 1 && !($controller === 'Pages' && $action === 'faq')): ?>
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
                        </div>
                        <!-- End of .col-sm-3 -->

                        <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                            <ul>
                                <li>
                                    <h3>Information</h3>
                                </li>
                                <li><a href="<?= $this->Url->build('/#AboutUs') ?>">About Us</a></li>
<!--                                <li><a href="#AboutUs">Reviews</a></li>-->
<!--                                <li><a href="#AboutUs">Returns & Refunds</a></li>-->
<!--                                <li><a href="#AboutUs">Terms & Conditions</a></li>-->
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <ul>
                                <li>
                                    <h3>Contact Us</h3>
                                </li>
                                <li><?= $this->Html->link('Send an enquiry', ['controller' => 'Messages', 'action' => 'contact'], ['class' => 'nav-link']) ?></li>
                                <li><?= $this->Html->link('FAQ', ['controller' => 'Pages', 'action' => 'faq'], ['class' => 'nav-link']) ?></li>
                            </ul>
                        </div>
                        <!-- End of .col-sm-3 -->

                    </div>
                </div> <!-- end container -->
            </div>
        </footer> <!-- end footer -->
    <?php endif; ?>

    <footer>
        <div class="footer-bottom">
            <h5>Created by JAVSS Solutions (Team076) 2025 &copy; </h5>
        </div>
    </footer>




<!--
    Essential Scripts
    =====================================-->
<!-- Main jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap4 -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
