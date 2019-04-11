<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\models\Price;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $keywords
 * @property string $img
 * @property string $accessories
 * @property string $vase
 * @property string $hit
 */
class Product extends \yii\db\ActiveRecord
{

    public $image;
    public $gallery;

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

    public function getPrices() {
        return $this->hasMany(Price::className(), ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'description_en', 'description_ru'], 'required'],
            [['category_id'], 'integer'],
            [['accessories', 'vase'], 'safe'],
            [['description_en', 'description_ru', 'hit'], 'string'],
            [['name', 'keywords'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Product №',
            'category_id' => 'Category',
            'name' => 'Name',
            'keywords' => 'Keywords',
            'description_en' => 'Description En',
            'description_ru' => 'Description Ru',
            'image' => 'Image',
            'accessories' => 'Accessories',
            'vase' => 'Vase',
            'hit' => 'Hit',
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->image->basename . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true, $this->image->basename);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }

    public function uploadGallery() {
        if ($this->validate()) {
            foreach ($this->gallery as $file) {
                $path = 'upload/store/' . $file->basename . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path, false, $file->basename);
                @unlink($path);
            }
            return true;
        } else {
            return false;
        }
    }
}
