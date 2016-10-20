<?php
namespace app\modules\testing\components;

use app\modules\testing\models\TestForm;
use Yii;
use app\modules\testing\models\Test;
use yii\base\Widget;
use yii\helpers\Html;

class DisplayTest extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if ($this->id === null)
            $this->id = 0;
    }

    public function run()
    {
        $model = new TestForm();
        return $this->render('displaytest',[
            'model'=>$model,
            'test'=>TestForm::loadTest($this->id),
            'id'=>$this->id
        ]);
    }
}