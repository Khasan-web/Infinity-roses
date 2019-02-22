<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_t".
 *
 * @property int $product_id
 * @property string $name
 * @property string $description
 * @property string $lang
 */
class ProductT extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_t';
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'name'], 'required'],
            [['product_id'], 'integer'],
            [['description', 'lang'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'lang' => Yii::t('app', 'Lang'),
        ];
    }
}
