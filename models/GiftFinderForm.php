<?php

namespace app\models;

use yii\base\Model;

class GiftFinderForm extends Model {

    public $event_1;
    public $event_2;
    public $event_3;
    public $large;
    public $fresh;
    public $infinity;
    public $price;
    public $price_min;
    public $price_max;

    public function rules()
    {
        return [
            [['event'], 'required'],
        ];
    }
}
