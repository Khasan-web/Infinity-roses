<?php

namespace app\models;

use yii\base\Model;

class GiftFinderForm extends Model {

    public $event;
    public $her;
    public $him;
    public $home;
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
