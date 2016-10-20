<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\testing\models\Test;

/* @var $this yii\web\View */
/* @var $model app\modules\testing\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-test-id">
        <?= Html::label('Список тестов', 'username', ['class' => 'control-label','for'=>'test-id']) ?>
        <?= Html::hiddenInput('Test[id]','') ?>
        <?= Html::dropDownList('Test[id]',ArrayHelper::getColumn($model->tests,'id'),
            ArrayHelper::map(Test::find()->select(['id','name'])->all(),'id','name'),['multiple'=>'multiple','class'=>'form-control','size'=>'4']
        ) ?>
        <div class="help-block"></div>
    </div>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'one' => 'один', 'multiple' => 'несколько', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
