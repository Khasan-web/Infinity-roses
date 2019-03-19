<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class OrderItems extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    public function getOrder() {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'color', 'name', 'price', 'qty_item', 'sum_item'], 'required'],
            [['order_id', 'product_id', 'parfume', 'chocolate', 'qty_item'], 'integer'],
            ['vase', 'safe'],
            [['size'], 'string'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}
