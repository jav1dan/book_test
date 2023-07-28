<?php
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
/** @var yii\web\View $this */

$this->title = Yii::t('backend','Users List');
?>
<div class="site-index">

    <div class="body-content">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'list-wrapper',
                'id' => 'list-wrapper',
            ],
            'itemView' => '_list',
            ]); 
        ?>
    </div>
</div>
