<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ru
 * @property string $date_from
 * @property string $date_to
 * @property string $description_en
 * @property string $description_ru
 * @property string $img
 */
class Events extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public $image;

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
            [['name_en', 'name_ru', 'description_en', 'description_ru'], 'required'],
            [['date_from', 'date_to'], 'safe'],
            [['description_en', 'description_ru'], 'string'],
            [['name_en', 'name_ru'], 'string', 'max' => 50],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Event №'),
            'name_en' => Yii::t('app', 'Name En'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'date_from' => Yii::t('app', 'Date From'),
            'date_to' => Yii::t('app', 'Date To'),
            'description_en' => Yii::t('app', 'Description En'),
            'description_ru' => Yii::t('app', 'Description Ru'),
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
