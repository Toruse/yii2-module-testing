<?php

namespace app\modules\testing\models;

use Yii;

/**
 * This is the model class for table "questions_tests".
 *
 * @property integer $id
 * @property integer $id_test
 * @property integer $id_question
 *
 * @property Questions $idQuestion
 * @property Tests $idTest
 */
class QuestionsTests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions_tests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_test', 'id_question'], 'integer'],
            [['id_question'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['id_question' => 'id']],
            [['id_test'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['id_test' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_test' => 'Id Test',
            'id_question' => 'Id Question',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'id_question']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'id_test']);
    }
}
