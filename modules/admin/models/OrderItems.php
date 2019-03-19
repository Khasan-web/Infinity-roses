<?php

namespace app\modules\admin\models;

use Yii;

class OrderItems extends \yii\db\ActiveRecord
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
            [['order_id', 'product_id', 'name', 'color', 'price', 'qty_item', 'sum_item'], 'required'],
            [['order_id', 'product_id', 'parfume', 'chocolate', 'qty_item'], 'integer'],
            ['vase', 'safe'],
            [['size'], 'string'],
            [['price', 'sum_item'], 'number'],
            [['name', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'name' => Yii::t('app', 'Name'),
            'size' => Yii::t('app', 'Size'),
            'color' => Yii::t('app', 'Color'),
            'parfume' => Yii::t('app', 'Parfume'),
            'chocolate' => Yii::t('app', 'Chocolate'),
            'price' => Yii::t('app', 'Price'),
            'qty_item' => Yii::t('app', 'Qty Item'),
            'sum_item' => Yii::t('app', 'Sum Item'),
        ];
    }
}
