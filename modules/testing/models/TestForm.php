<?php
namespace app\modules\testing\models;

use Yii;
use yii\base\Model;
use yii\validators\NumberValidator;

class TestForm extends Model
{
    public $id_test;
    public $answers;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id_test', 'required'],
            ['id_test', 'integer'],
            ['answers', 'validateAnswers']
        ];
    }

    public function attributeLabels()
    {
        return [
            'answers' => 'Список ответов',
        ];
    }

    public function validateAnswers($attribute, $params)
    {
        $validator = new NumberValidator();
        if (is_array($this->$attribute))
            foreach ($this->$attribute as $id=>$question) {
                if (is_array($question)) {
                    foreach ($question as $anser) {
                        if (!$validator->validate($anser, $error)) {
                            $this->addError($attribute, 'В списке не целые числа.');
                        }
                    }
                } else
                    $this->addError($attribute, 'В списке не целые числа.');
            }
        else
            $this->addError($attribute, 'В списке не целые числа.');
        return true;
    }

    static public function loadTest($id)
    {
        $sql="SELECT 
                tests.id AS id, 
                tests.name AS name, 
                questions.id AS id_question, 
                questions.title AS title, 
                questions.type AS type_question, 
                answers.id AS id_answer, 
                answers.text AS text, 
                answers.type AS type_answer 
            FROM tests 
                LEFT JOIN questions_tests ON tests.id=questions_tests.id_test 
                LEFT JOIN questions ON questions_tests.id_question=questions.id 
                LEFT JOIN answers ON answers.id_question=questions.id 
            WHERE tests.id=:test_id";
        $result=Yii::$app->db->createCommand($sql)
            ->bindValue(':test_id',$id)
            ->queryAll();
        if ($result) {
            $data=[];
            foreach ($result as $key=>$res)
            {
                $data['id']=$res['id'];
                $data['name']=$res['name'];
                $data['questions'][$res['id_question']]['title']=$res['title'];
                $data['questions'][$res['id_question']]['type']=$res['type_question'];
                $data['questions'][$res['id_question']]['answers'][$res['id_answer']]['text']=$res['text'];
                $data['questions'][$res['id_question']]['answers'][$res['id_answer']]['type']=$res['type_answer'];
            }
            return $data;
        } else {
            return false;
        }
    }

    static public function getCorrectAnswers($id)
    {
        $sql="SELECT 
                questions.id AS id_question, 
                questions.type AS type_question, 
                answers.id AS id_answer 
            FROM questions_tests 
                LEFT JOIN questions ON questions_tests.id_question=questions.id 
                LEFT JOIN answers ON answers.id_question=questions.id 
            WHERE questions_tests.id_test=:test_id AND answers.type='right'";
        $result=Yii::$app->db->createCommand($sql)
            ->bindValue(':test_id',$id)
            ->queryAll();
        if ($result) {
            $data=[];
            foreach ($result as $res)
            {
                $data[$res['id_question']][]=$res['id_answer'];
            }
            return $data;
        } else {
            return false;
        }
    }
}
