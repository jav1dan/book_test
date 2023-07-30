<?php
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = Yii::t('backend','Users List');
?>
<div class="site-index">
    <div class="d-flex justify-content-end">    
        <?= Html::a(Yii::t('backend','Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="body-content">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '<thead><th>'.Yii::t('backend','username').'</th><th>'.Yii::t('backend','status').'</th><th>'.Yii::t('backend','action').'</th></thead><tbody></=>{items}</tbody>{pager}',
            'options' => [
                'tag' => 'table',
                'class' => 'table-hover table',
                'id' => 'list-wrapper',
            ],
            'itemView' => '_list',
            ]); 
        ?>
    </div>
</div>
