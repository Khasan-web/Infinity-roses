<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "background".
 *
 * @property int $id
 * @property string $filePath
 * @property string $position
 * @property string $title_en
 * @property string $title_ru
 * @property string $description_en
 * @property string $description_ru
 */
class Background extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'background';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filePath', 'title_en', 'title_ru', 'description_en', 'description_ru'], 'required'],
            [['filePath'], 'string', 'max' => 400],
            [['position', 'description_en', 'description_ru'], 'string', 'max' => 150],
            [['title_en', 'title_ru'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Background ID',
            'filePath' => 'File Path',
            'position' => 'Position',
            'title_en' => 'Title En',
            'title_ru' => 'Title Ru',
            'description_en' => 'Description En',
            'description_ru' => 'Description Ru',
        ];
    }
}
