<?php

use yii\helpers\Html;
use common\models\Author;
use yii\bootstrap5\ActiveForm;
use artkost\yii2\trumbowyg\Trumbowyg;
//add js file

$this->title = $model->isNewRecord?Yii::t('backend','Create Book'):Yii::t('backend','Update Book').': '.$model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    $form = ActiveForm::begin(['id'=>'book-form',
    'action'=>$model->isNewRecord ? ['book/create'] : ['book/update','id'=>$model->id],
    'fieldConfig'=>[
        'template'=>'{label}{input}{error}'
    ]]);
?>
<?=$form->field($model,'name',[
    'options'=>['class'=>'mb-3']
])->textInput(['maxlength'=>true])?>
<?=$form->field($model,'isbn',[
    'options'=>['class'=>'mb-3']
])->textInput(['maxlength'=>true])?>
<?=$form->field($model,'year',[
    'options'=>['class'=>'mb-3']
])->textInput(['maxlength'=>true])?>
<?=$form->field($model, 'description')->widget(Trumbowyg::className(), [
    'settings' => [
        'lang' => 'ru'
    ]
]);?>
<div class="form-group row align-items-baseline">
    <?=$form->field($model,'authors[]',[
        'options'=>['class'=>'mb-3 main-select']
    ])->dropDownList(Author::listAll(),[
        'prompt'=>Yii::t('backend','Select Author'),
        'class'=>'form-control',
        'id'=>'author_id',
        'multiple'=>'multiple',
    ])?>
</div>

<div class="form-group row align-items-baseline">
    <div class="col-sm-2">
        <?=Yii::t('backend','Photo')?>
    </div>
    <div class="col-sm-10">
        <a data-bs-toggle="modal" href="#modal-upload"> 
            <input type="hidden" name="Book[photo]" id="photo" value="<?=$model->photo?>"/>
            <img src="<?=Yii::$app->params['frontend_url']."/".$thumb?>" alt="" class="img-fluid img-thumbnail" style="max-width:100px;" id="image-thumb">
           
        </a>
         <button type="button" onclick="setDefaultPicture()" class="btn btn-sm btn-danger"><?=Yii::t('backend','Remove')?></button>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="modal-upload" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"><?=Yii::t('backend','Select Photo')?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body">                
                <?php echo \common\components\DropZone::widget([
                    'options' => [
                        'url' => \yii\helpers\Url::to(['book/upload']),
                        'maxFilesize' => '1',
                        'maxFiles' => '1',
                        'acceptedFiles' => 'image/*',
                        'addRemoveLinks' => true,
                        'dictRemoveFile' => 'Remove',
                        'dictDefaultMessage' => 'Upload Photo',
                    ],
                    'clientEvents' => [
                        'complete' => "function(file){
                            console.log(file);
                            let respon = file.xhr.response;
                            let fileX = JSON.parse(respon);
                            console.log(fileX);
                            
                            document.getElementById('photo').value = fileX.name;
                            document.getElementById('image-thumb').setAttribute('src',fileX.url);
                            console.log(fileX.url);
                        }",
                        'removedfile' => "function(file){alert(file.name + ' is removed')}",
                    ],
                ]);?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=Yii::t('backend','Close')?></button>
            </div>
        </div>
    </div>
</div>
<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
    <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary btn-block', 'name' => 'book-button']) ?>
</div>
<script>
    function setDefaultPicture(){
        document.getElementById('photo').value = '';
        document.getElementById('image-thumb').setAttribute('src','<?=Yii::$app->params['frontend_url']."/default.jpg"?>');
    }
</script>
<?php
ActiveForm::end();
?>