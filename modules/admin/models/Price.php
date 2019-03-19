<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property string $size
 * @property int $width
 * @property int $height
 * @property int $price
 * @property int $product_id
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size', 'price', 'product_id'], 'required'],
            [['price', 'product_id', 'width', 'height'], 'integer'],
            [['size'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'size' => 'Size',
            'width' => 'Width',
            'height' => 'Height',
            'price' => 'Price',
            'product_id' => 'Product ID',
        ];
    }
}
