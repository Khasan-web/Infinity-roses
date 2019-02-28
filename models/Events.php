<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $name
 * @property string $date_from
 * @property string $date_to
 * @property string $description_en
 * @property string $description_ru
 * @property string $product_id
 * @property string $img
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date_from', 'date_to', 'description_en', 'description_ru', 'product_id', 'img'], 'required'],
            [['date_from', 'date_to'], 'safe'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['product_id', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'date_from' => Yii::t('app', 'Data From'),
            'date_to' => Yii::t('app', 'Data To'),
            'description_en' => Yii::t('app', 'Description En'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'product_id' => Yii::t('app', 'Product ID'),
            'img' => Yii::t('app', 'Img'),
        ];
    }
}
