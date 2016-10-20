<?php

/* @var $this yii\web\View */

$this->title = 'ТестКомпани';
?>
<div class="site-index">
        <?= $this->render('_displaytest', [
            'model' => $model,
        ]) ?>
</div>
