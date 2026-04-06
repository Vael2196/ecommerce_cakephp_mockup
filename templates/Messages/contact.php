<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
?>
<!---->
<!--    <div class="container px-4 px-lg-5">-->
<!--        <div class="row gx-0 ">-->
<!--            <div class="left">-->
<!--                <h2 class="my-color text-start">We are here to help!</h2>-->
<!--                <br>-->
<!--                <p class="my-text text-start">Let us know how we can best serve you. <br>We will get back to you within 3 business days.</p>-->
<!--            </div>-->
<!--            <div class="col-lg-6">-->
<!---->
<!--                            --><?php //= $this->Form->create($message, ['class' => 'form-horizontal my-text text-start']) ?>
<!--                            --><?php //= $this->Form->control('name', ['class' => 'form-control my-text text-start ', 'label' => 'Name']) ?>
<!--                            --><?php //= $this->Form->control('email', ['class' => 'form-control my-text text-start', 'label' => 'Email']) ?>
<!--                            --><?php //= $this->Form->control('subject', ['class' => 'form-control my-text text-start', 'label' => 'Subject']) ?>
<!--                            --><?php //= $this->Form->control('message', [
//                                'class' => 'form-control',
//                                'label' => 'Message',
//                                'type' => 'textarea'
//                            ]) ?>
<!--                            <div class="mt-3 align-items-center">-->
<!--                                <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>-->
<!--                            </div>-->
<!--                            <div class="mt-3">-->
<!--                                --><?php //= $this->Form->button(__('Send Message'), ['class' => 'btn btn-primary']) ?>
<!--                            </div>-->
<!--                            --><?php //= $this->Form->end() ?>
<!--                        </div>-->
<!--                        --><?php //= $this->Html->script('https://www.google.com/recaptcha/api.js') ?>
<!---->
<!--        </div>-->
<!---->
<!---->
<!--    </div>-->

<!--Start Contact Us
   =========================================== -->
<section class="contact-us" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <!-- section title -->
            <div class="col-xl-6 col-lg-8">
                <div class="title text-center">
                    <h2>Contact Us</h2>
                    <p>Let us know how we can best serve you.
                        <br>We will get back to you within 3 business days.</p>
                    <div class="border"></div>
                </div>
            </div>
            <!-- /section title -->
        </div>
        <div class="row">
            <!-- Contact Details -->
            <div class="contact-details col-md-6 ">
                <h4 class="mb-3">Get in touch with us</h4>
                <ul class="contact-short-info mt-4">
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
                    <li class="mb-3">
                        <i class="tf-ion-ios-home"></i>
                        <p>A: <?= $address ?></p>
                    </li>
                    <li class="mb-3">
                        <i class="tf-ion-android-phone-portrait"></i>
                        <p>P: <?= $phone ?></p>
                    </li>
<!--                    <li>-->
<!--                        <i class="tf-ion-android-mail"></i>-->
<!--                        <p>E: hello@crunchycravings.com</p>-->
<!--                    </li>-->
                </ul>
            </div>
            <!-- / End Contact Details -->

            <!-- Contact Form -->
            <div class="contact-form col-md-6 ">
                <form id="contact-form" method="post" role="form">

                    <?= $this->Form->create($message, ['class' => 'form-horizontal my-text text-start']) ?>

                    <div class="form-group mb-4">
                        <?= $this->Form->control('name', [
                            'type' => 'text',
                            'label' => false, // removes the default label
                            'placeholder' => 'Your Name',
                            'class' => 'form-control',
                            'required' => true,
                            'id' => 'name'
                        ]) ?>
                    </div>

                    <div class="form-group mb-4">
                        <?= $this->Form->control('email', [
                            'type' => 'email',
                            'label' => false,
                            'placeholder' => 'Your Email',
                            'class' => 'form-control my-text text-start',
                            'required' => true,
                            'id' => 'email'
                        ]) ?>
                    </div>

                    <div class="form-group mb-4">
                        <?= $this->Form->control('subject', [
                            'type' => 'text',
                            'label' => false,
                            'placeholder' => 'Subject',
                            'class' => 'form-control my-text text-start',
                            'id' => 'subject'
                        ]) ?>
                    </div>

                    <div class="form-group mb-4">
                        <?= $this->Form->control('message', [
                            'type' => 'textarea',
                            'label' => false,
                            'placeholder' => 'Message',
                            'class' => 'form-control',
                            'rows' => 5,
                            'maxlength' => 100,
                            'id' => 'message'
                        ]) ?>
                        <small id="msg-counter" class="form-text text-muted">
                            100 characters remaining
                        </small>
                    </div>

                    <div class="mt-3" style="padding-bottom: 20px;">
                        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                    </div>

                    <div id="cf-submit">
                        <?= $this->Form->button(__('Submit'), [
                            'type' => 'submit',
                            'id' => 'contact-submit',
                            'class' => 'btn btn-transparent'
                        ]) ?>
                    </div>

                    <?= $this->Form->end() ?>
                    <?= $this->Html->script('https://www.google.com/recaptcha/api.js') ?>
                </form>
            </div>
            <!-- ./End Contact Form -->

        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end section -->

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
    document.addEventListener('DOMContentLoaded', function() {
        const msg = document.getElementById('message');
        const counter = document.getElementById('msg-counter');
        const max = parseInt(msg.getAttribute('maxlength'), 10) || 100;

        function updateCount() {
            const used = msg.value.length;
            const left = Math.max(0, max - used);
            counter.textContent = `${left} characters remaining`;
        }

        updateCount();
        msg.addEventListener('input', updateCount);
    });
</script>

</body>

</html>
