<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<tr>
    <td><?= $model->id ?></td>
    <td><?= Html::encode($model->username) ?></td>
    <td><?= Html::encode($model->status) ?></td>
    <td>
        <a href="<?= \yii\helpers\Url::to(['user/update', 'id' => $model->id]) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
        <a href="<?= \yii\helpers\Url::to(['user/delete', 'id' => $model->id]) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
    </td>
</tr>