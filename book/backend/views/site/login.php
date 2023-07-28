<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = Yii::t('backend', 'Login')
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4"><?= Html::encode($this->title) ?></h3></div>
                <div class="card-body">
                    <p><?=Yii::t('backend','Please fill out the following fields to login:');?></p>
                    <?php $form = ActiveForm::begin(['id' => 'login-form',
                    'fieldConfig'=>[
                    'template'=>'{input}{label}{error}'
                ]]); ?>
                        <?= $form->field($model, 'username',[
                            'options'=>['class'=>'form-floating mb-3',
                            
                        ]
                        ])->textInput(['autofocus' => true,'placeholder'=>Yii::t('backend','Enter your username')])->label(Yii::t('backend','Username')); ?>

                        <?= $form->field($model, 'password',[
                            'options'=>['class'=>'form-floating mb-3']
                        ])->passwordInput(['placeholder'=>\Yii::t('backend','Enter your password')])->label(\Yii::t('backend','Password')) ?>

                        <?= $form->field($model, 'rememberMe')->label(Yii::t('backend','Remember Me'))->checkbox() ?>    
                       
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <?= Html::submitButton(Yii::t('backend', 'LoginButton'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="card-footer text-center py-3">
                    
                </div>
            </div>
        </div>
    </div>
</div>
