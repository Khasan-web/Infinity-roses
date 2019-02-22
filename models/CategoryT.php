<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_t".
 *
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property string $lang
 */
class CategoryT extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_t';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id'], 'integer'],
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
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'lang' => Yii::t('app', 'Lang'),
        ];
    }
}
