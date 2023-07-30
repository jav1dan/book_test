<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = Yii::t('backend','Authors List');
?>
<div class="site-index">
    <div class="d-flex justify-content-end">    
        <?= Html::a(Yii::t('backend','Create Author'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="body-content">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'table',
                'class' => 'table table-responsive',
                'id' => 'list-wrapper',
            ],
            'itemView' => '_list',
            ]); 
        ?>
    </div>
</div>
