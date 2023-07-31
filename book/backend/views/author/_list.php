<tr>
    <td><?= $model->id ?></td>
    <td><?= $model->name; ?></td>
    <td><?= $model->surname; ?></td>
    <td><?= $model->fathername; ?></td>
    <td>
        <?php if(!Yii::$app->user->isGuest):?>
            <a href="<?= \yii\helpers\Url::to(['author/update', 'id' => $model->id]) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
            <a href="<?= \yii\helpers\Url::to(['author/delete', 'id' => $model->id]) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        <?php endif;?>
        <a href="<?= \yii\helpers\Url::to(['author/view', 'id' => $model->id]) ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
    </td>
</tr>