<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property int $price
 * @property string $keywords
 * @property string $img
 * @property string $hit
 * @property string $size
 */
class Product extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'price', 'img'], 'required'],
            [['category_id', 'price'], 'integer'],
            [['hit', 'size'], 'string'],
            [['keywords'], 'string', 'max' => 255],
            [['img'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'price' => Yii::t('app', 'Price'),
            'keywords' => Yii::t('app', 'Keywords'),
            'img' => Yii::t('app', 'Img'),
            'hit' => Yii::t('app', 'Hit'),
            'size' => Yii::t('app', 'Size'),
        ];
    }
}
