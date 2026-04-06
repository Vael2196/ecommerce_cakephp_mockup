<?php
/**
 * @var \App\View\AppView $this
 * @var string $message
 * @var string $url
 */
use Cake\Core\Configure;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.php');

    $this->start('file');
    echo $this->element('auto_table_warning');
    $this->end();
endif;
?>

<style>
    .page-404 {
        padding: 100px 0;
        text-align: center;
    }
    .page-404 h1 {
        font-size: 300px;
        font-weight: bold;
        line-height: 300px;
        margin-top: 30px;
    }
    @media (max-width: 480px) {
        .page-404 h1 {
            font-size: 130px;
            line-height: 150px;
        }
    }
    @media (max-width: 400px) {
        .page-404 h1 {
            font-size: 100px;
            line-height: 100px;
        }
    }
    @media (max-width: 768px) {
        .page-404 h1 {
            font-size: 150px;
            line-height: 200px;
        }
    }
    .page-404 h2 {
        text-transform: uppercase;
        font-size: 20px;
        letter-spacing: 4px;
        font-weight: bold;
        margin-top: 30px;
    }
    .page-404 .copyright-text {
        margin-top: 50px;
        font-size: 12px;
    }
    .page-404 .btn-main, .page-404 .btn-solid-border, .page-404 .btn-transparent, .page-404 .btn-small {
        margin-top: 40px;
    }
</style>


<h2><?= h($message) ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
</p>

<body id="body">
<section class="page-404">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="navbar-brand" href="<?= $this->Url->build('/') ?>">
                    <?= $this->Html->image('Crunchy-Cravings-3.png', ['alt' => 'Logo', 'class' => 'navbar-brand.img', 'width' => '200px', 'height' => 'auto']) ?>
                </a>
                <h1>404</h1>
                <h2>Page Not Found</h2>
                <div class="col-md-6">
                    <?= $this->Html->link('Return Home', ['controller' => 'Pages', 'action' => 'display', 'home'], ['class' => 'btn btn-main']) ?>
                </div>
            </div>
        </div>
    </div>
</section>


