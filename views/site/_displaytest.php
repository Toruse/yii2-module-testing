<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 20.10.2016
 * Time: 19:27
 */
use app\modules\testing\components\DisplayTest;
use app\modules\testing\models\Test;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>
<?php Pjax::begin(); ?>
<?= Html::beginForm(['site/display-test'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
<?= Html::dropdownList('id_test',null,
    ArrayHelper::map(Test::find()->select(['id','name'])->all(),'id','name')
); ?>
    <div class="form-group">
<?= Html::submitButton('Прости тест', ['class' => 'btn btn-primary btn-bg', 'name' => 'hash-button']) ?>
    </div>
<?= Html::endForm() ?>
<?= DisplayTest::widget(['id'=>($id_test)?$id_test:1,'message' => 'Good morning']) ?>
<?php Pjax::end(); ?>