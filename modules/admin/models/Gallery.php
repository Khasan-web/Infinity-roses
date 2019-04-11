<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\models\Category;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string $img
 * @property int $category_id
 */
class Gallery extends \yii\db\ActiveRecord
{
    public $gallery;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
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
            [['category_id'], 'required'],
            // [['category_id'], 'integer'],
            ['gallery', 'file', 'maxFiles' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
        ];
    }

}
