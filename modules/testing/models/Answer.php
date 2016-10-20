<?php

namespace app\modules\testing\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property integer $id
 * @property integer $id_question
 * @property string $text
 * @property string $type
 *
 * @property Questions $idQuestion
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_question'], 'integer'],
            [['text', 'type'], 'string'],
            [['id_question'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['id_question' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_question' => 'Вопрос',
            'text' => 'Text',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'id_question']);
    }
}
