<?php

namespace app\modules\testing\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property integer $id
 * @property string $title
 * @property string $type
 *
 * @property Answers[] $answers
 * @property QuestionsTests[] $questionsTests
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['title'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок вопроса',
            'type' => 'Количество ответов',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['id_question' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsTests()
    {
        return $this->hasMany(QuestionsTests::className(), ['id_question' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests(){
        return $this->hasMany(Test::className(), ['id' => 'id_test'])
            ->viaTable('questions_tests', ['id_question' => 'id']);
    }
}
