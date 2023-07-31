<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title=Yii::t('backend','Top 10 Authors By Books Count In Year');
?>
<h2><?=Yii::t('backend','Top 10 Authors By Books Count In Year')?></h2>
<div class="form-group mb-4 mt-2">
    <label for="year"><?=Yii::t('backend','Year')?></label>
    <select name="year" id="year" class="form-control">
        <?php for($i=2021;$i>=1900;$i--):?>
            <option value="<?=$i?>" <?=($year==$i)?'selected':''?>><?=$i?></option>
        <?php endfor;?>
    </select>
</div>
<table class="table table-bordered">
    <thead>
        <th><?=Yii::t('backend','Author')?></th>
        <th><?=Yii::t('backend','Books Count')?></th>
    </thead>
    <tbody>
        <?php foreach($authors as $author):?>
            <tr>
                <td><?=$author->name." ".$author->surname?></td>
                <td><?=$author->booksCount?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<script>
    document.getElementById('year').addEventListener('change',function(){
        window.location.href='<?=Url::to(['report/top10'])?>?year='+this.value;
    })
</script>