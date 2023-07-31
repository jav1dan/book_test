<tr>
    <td><?= $model->id ?></td>
    <td><?= $model->name; ?></td>
    <td><?= $model->year; ?></td>
    <td><?=$model->isbn; ?></td>
    <td>
        <?php if(!Yii::$app->user->isGuest): ?>
            <a href="<?= \yii\helpers\Url::to(['book/update', 'id' => $model->id]) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
            <a href="<?= \yii\helpers\Url::to(['book/delete', 'id' => $model->id]) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        <?php endif; ?>
        <a href="<?= \yii\helpers\Url::to(['book/view', 'id' => $model->id]) ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
    </td>
</tr>