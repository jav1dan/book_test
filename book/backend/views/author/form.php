<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

if($model->isNewRecord){
    $this->title=Yii::t('backend','Create Author');
}else{
    $this->title=Yii::t('backend','Update Author').': '.$model->name;
}
$this->params['breadcrumbs'][]=['label'=>Yii::t('backend','Authors'),'url'=>['index']];
$this->params['breadcrumbs'][]=$this->title;
?>
        <?php $form = ActiveForm::begin(['id' => 'author-form',
        'action'=>$model->isNewRecord ? ['author/create'] : ['author/update','id'=>$model->id],
        'fieldConfig'=>[
            'template'=>'{input}{label}{error}'
        ]]);
        ?>
        <?=$form->field($model,'name',[
            'options'=>['class'=>'form-floating mb-3']
        ])->textInput(['maxlength'=>true])?>
        <?=$form->field($model,'surname',[
            'options'=>['class'=>'form-floating mb-3']
        ])->textInput(['maxlength'=>true])?>
        <?=$form->field($model,'fathername',[
            'options'=>['class'=>'form-floating mb-3']
        ])->textInput(['maxlength'=>true])?>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary btn-block', 'name' => 'author-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>