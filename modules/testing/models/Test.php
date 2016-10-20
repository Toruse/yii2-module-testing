<?php

namespace app\modules\testing\models;

use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property QuestionsTests[] $questionsTests
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsTests()
    {
        return $this->hasMany(QuestionsTests::className(), ['id_test' => 'id']);
    }
}
