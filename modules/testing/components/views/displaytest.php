<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if ($test) {
    $id_form='form_answers_'.uniqid();
?>
    <div class="text-left">
        <h1><?= $test['name'] ?></h1>
<?php
    $form = ActiveForm::begin([
        'id' => $id_form,
        'action' => ['/testing'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,

    ]);
    echo $form->field($model, 'id_test')->hiddenInput(['value'=>$id])->label(false);
    foreach ($test['questions'] as $id_question=>$question) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading"><?= $question['title']?></div>
            <div class="panel-body">
        <?php
        if ($question['type']=='one') {
            echo $form->field($model,'answers['.$id_question.'][]')->radioList(ArrayHelper::getColumn($question['answers'],'text'),
                [
                    'unselect' => null,
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="radio"><label ' . ($checked ? ' active' : '') . '">' .
                        Html::radio($name, $checked, ['value' => $value]) . $label . '</label></div>';
                    }
                ]
            )->label(false);
        }
        else
        {
            echo $form->field($model,'answers['.$id_question.'][]')->checkboxList(ArrayHelper::getColumn($question['answers'],'text'),
                [
                    'unselect' => null,
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<div class="checkbox"><label ' . ($checked ? ' active' : '') . '">' .
                        Html::checkbox($name, $checked, ['value' => $value]) . $label . '</label></div>';
                    }
                ]
            )->label(false);
        }
        ?>
            </div>
        </div>
        <?php
    }
?>
        <div class="form-group">
            <?= Html::submitButton('Проверить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
<?php
    ActiveForm::end();
    $js = <<<JS
        $(document).ready(
                $('#{$id_form}').on('beforeSubmit', function(event, jqXHR, settings) {
                        var form = $(this);
                        
                        $.ajax({
                                url: form.attr('action'),
                                type: 'post',
                                data: form.serialize(),
                                dataType: "JSON",
                                success: function(data) {
                                    if (data.status)
                                    {
                                        alert(data.message+' Количество набранных балов:'+data.result+'.');
                                    }
                                }
                        });
                        
                        return false;
                })
        );
JS;
    $this->registerJs($js);
}
?>