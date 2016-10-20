<?php

namespace app\modules\testing\controllers;

use app\modules\testing\models\QuestionsTests;
use app\modules\testing\models\TestForm;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `testing` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $model=new TestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data=TestForm::getCorrectAnswers($model->id_test);
            $countQuestions=count($data);
            $correctAnswers=0;
            if (is_array($model->answers))
                foreach ($model->answers as $id=>$answer) {
                    if (count(array_diff($answer, $data[$id])) == 0 && count(array_diff($data[$id], $answer)) == 0)
                        $correctAnswers++;
                }
            if ($correctAnswers==$countQuestions)
                $message='Вы прошли тест.';
            else
                $message='Вы провалили тест.';
            $data = ['result' => round($correctAnswers/$countQuestions*100), 'status' => 'true', 'message' => $message];
        }
        else
        {
            $data=['status'=>'false','message'=>'Ошибка в полученных данных!'];
        }
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
