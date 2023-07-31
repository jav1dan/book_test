<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\models\User;
use yii\widgets\ActiveForm;

$this->title= $model->isNewRecord ? Yii::t('backend','Create User') : Yii::t('backend','Update User').': '.$model->username;

$this->params['breadcrumbs'][]=['label'=>Yii::t('backend','Users'),'url'=>['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'user-form',
    'action'=>$model->isNewRecord ? ['user/create'] : ['user/update','id'=>$model->id],
    'fieldConfig'=>[
        'template'=>'{input}{label}{error}'
    ]]);
    ?>
    <?=$form->field($model,'username',[
        'options'=>['class'=>'form-floating mb-3']
    ])->textInput(['maxlength'=>true])?>
    <?=$form->field($model,'status',[
        'options'=>['class'=>'form-floating mb-3']
    ])->dropDownList(User::getStatuses())?>
    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary btn-block', 'name' => 'user-button']) ?>
    </div>
    <?php ActiveForm::end(); ?> 
