<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
/** @var yii\web\View $this */


$this->title=Yii::t('backend','Subscribe to author').': '.$author->name." ".$author->surname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h2><?=Yii::t('backend','Subscribe to author?')?></h2>
<p><?=Yii::t('backend','Author Name:');?>&nbsp;&nbsp;<?=$author->name." ".$author->surname?></p>
<?php 
$form = ActiveForm::begin(['id'=>'subscribe-form', 'action'=>['author/subscribe','id'=>$author->id],
'fieldConfig'=>[
    'template'=>'{input}{label}{error}'
]
]);?>
<input type="hidden" name="author_id" value="<?=$author->id?>">
<div class="form-group mb-4 row form-row align-items-baseline">
    <label class="control-label col-sm-2" for="subscribe-phone"><?=Yii::t('backend','Phone')?></label>
    <div class="col-sm-10">
        <input type="text" name="phone" id="subscribe-phone" class="form-control" placeholder="<?=Yii::t('backend','Phone')?>">
    </div>
</div>
<div class="form-group mb-4 row form-row align-items-baseline">
    <label class="control-label col-sm-2" for="subscribe-name"><?=Yii::t('backend','Name')?></label>
    <div class="col-sm-10">
        <input type="text" name="name" id="subscribe-name" class="form-control" placeholder="<?=Yii::t('backend','Name')?>">
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton(Yii::t('backend', 'Subscribe'), ['class' => 'btn btn-primary', 'name' => 'subscribe-button']) ?>
    <a href="<?=Url::to(['author/view','id'=>$author->id])?>" class="btn btn-danger"><?=Yii::t('backend','Cancel')?></a>
</div>
<?php ActiveForm::end();?>
