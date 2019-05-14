<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $paernt_id
 * @property string $name_en
 * @property string $name_ru
 * @property string $description_en
 * @property string $description_ru
 * @property string $keywords
 */
class Category extends \yii\db\ActiveRecord
{

    public $image;

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

    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
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
            ['parent_id', 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Category №',
            'parent_id' => 'Parent Category',
            'name_en' => 'Name En',
            'name_ru' => 'Name Ru',
            'description_en' => 'Description En',
            'description_ru' => 'Description Ru',
            'keywords' => 'Keywords',
            'image' => 'Image',
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
