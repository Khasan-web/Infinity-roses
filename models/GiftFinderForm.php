<?php

namespace app\models;

use yii\base\Model;

class GiftFinderForm extends Model
{
    public $event;
    public $fresh;
    public $infinity;

    public function rules()
    {
        return [
            [['event'], 'required'],
        ];
    }
}
