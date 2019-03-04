<?php

namespace app\models;

use yii\base\Model;

class GiftFinderForm extends Model {

    public $price_min;
    public $price_max;

    public function rules()
    {
        return [
            [['event'], 'required'],
        ];
    }
}
