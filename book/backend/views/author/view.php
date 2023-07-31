<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap5\ActiveForm;
$this->title = $model->name." ".$model->surname;
$this->params['breadcrumbs'][]=['label'=>Yii::t('backend','Authors'),'url'=>['index']];
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="site-index">
    <div class="table-responsive">  
        <table class="table">   
            <thead>
                <th><?=Yii::t('backend','Parameter key')?></th>
                <th><?=Yii::t('backend','Parametr value')?></th>
            </thead>
            <tbody>
                <tr>
                    <td><?=Yii::t('backend','ID')?></td>
                    <td><?=$model->id?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('backend','Name')?></td>
                    <td><?=$model->name?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('backend','Surname')?></td>
                    <td><?=$model->surname?></td>
                </tr>
                <tr>
                    <td><?=Yii::t('backend','Fathername')?></td>
                    <td><?=$model->fathername?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong><?=Yii::t('backend','Books')?></strong></td>
                </tr>
                <?php foreach($model->books as $book):?>
                    <tr>
                        <td><?=$book->name?></td>
                        <td>
                            <a href="<?= \yii\helpers\Url::to(['book/view', 'id' => $book->id]) ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<a href="<?= \yii\helpers\Url::to(['author/index']) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
<a href="<?= \yii\helpers\Url::to(['author/subscribe', 'id' => $model->id]) ?>" class="btn btn-success"><i class="fa fa-bell"></i>&nbsp;<?=Yii::t('backend','Subscribe To Author')?></a>
<?php if(!Yii::$app->user->isGuest): ?>
    <a href="<?= \yii\helpers\Url::to(['author/update', 'id' => $model->id]) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
    <a href="<?= \yii\helpers\Url::to(['author/delete', 'id' => $model->id]) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
<?php endif; ?>