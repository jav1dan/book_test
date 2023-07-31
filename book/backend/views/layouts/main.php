<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?=Yii::$app->homeUrl;?>"><?=Yii::$app->name;?></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </div>
        <?php if(Yii::$app->user->isGuest):?>
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <?=Html::a(Yii::t('backend','Login'),['/site/login'],['class' => ['btn btn-primary']]);?>
            </div>
        <?php else:?>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" onclick="logoutFunction()"><?=Yii::t('backend','Logout')?></a></li>
                </ul>
            </li>
        </ul>
        <?php endif;?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"><?=Yii::t('backend','Core');?></div>
                        <a class="nav-link" href="/">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            <?=Yii::t('backend','Main Page');?>
                        </a>
                        <div class="sb-sidenav-menu-heading"><?=Yii::t('backend','My Application')?></div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            <?=Yii::t('backend','Data')?>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <?php if(!Yii::$app->user->isGuest):?>
                                     <a class="nav-link" href="/user"><?=Yii::t('backend','Users List');?></a>
                                    <a class="nav-link" href="/user/create"><?=Yii::t('backend','Add User');?></a>
                                <?php endif;?>
                                <a class="nav-link" href="/book"><?=Yii::t('backend','Books List');?></a>
                                <?php if(!Yii::$app->user->isGuest):?>
                                    <a class="nav-link" href="/book/create"><?=Yii::t('backend','Add Book');?></a>
                                <?php endif;?>
                                <a class="nav-link" href="/author"><?=Yii::t('backend','Authors List');?></a>
                                <?php if(!Yii::$app->user->isGuest):?>
                                    <a class="nav-link" href="/author/create"><?=Yii::t('backend','Add Author');?></a>
                                <?php endif;?>
                            </nav>
                        </div>      
                        <a class="nav-link" href="/report/top10">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            <?=Yii::t('backend','Report about top 10 authors');?>
                        </a>
                    </div>
                </div>
                <?php if(!Yii::$app->user->isGuest):?>
                <div class="sb-sidenav-footer">
                    <div class="small"><?=Yii::t('backend','logged_in')?></div>
                    <?=Yii::$app->user->identity->username;?>
                </div>
                <?php else:?>
                    <div class="sb-sidenav-footer">
                        <div class="small"><?=Yii::t('backend','Welcome, stranger')?></div>
                    </div>  
                <?php endif;?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?=Html::encode($this->title)?></h1>
                        <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <?= $content ?>
                        </div>
                    </div>                      
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; <?=Yii::t('backend','Book.JAVIDAN');?></div>
                        <div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
