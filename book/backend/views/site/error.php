<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception*/

use yii\helpers\Html;

$this->title = $name;
?>
<div id="layoutError">
    <div id="layoutError_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mt-4">
                            <h1><?= Html::encode($this->title) ?></h1>
                            <img class="mb-4 img-error" src="img/error-404-monochrome.svg" />
                            <p class="lead"><?= nl2br(Html::encode($message)) ?></p>
                            <a href="/">
                                <i class="fas fa-arrow-left me-1"></i>
                                <?=Yii::t('backend','Return to Dashboard')?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
</div>
