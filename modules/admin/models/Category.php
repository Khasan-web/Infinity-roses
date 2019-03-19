<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ru
 * @property string $description_en
 * @property string $description_ru
 * @property string $keywords
 */
class Category extends \yii\db\ActiveRecord
{

    public $image;
    public $secondary;

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
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en', 'name_ru', 'description_en', 'description_ru', 'keywords'], 'required'],
            [['description_en', 'description_ru'], 'string'],
            [['name_en', 'name_ru', 'keywords'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
            // attr secondary hide this category in navbar
            ['secondary', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Category №'),
            'name_en' => Yii::t('app', 'Name En'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'description_en' => Yii::t('app', 'Description En'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'keywords' => Yii::t('app', 'Keywords'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->image->basename . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }

}
