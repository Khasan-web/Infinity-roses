<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ru
 * @property string $keywords
 * @property string $date_from
 * @property string $date_to
 * @property string $description_en
 * @property string $description_ru
 * @property string $product_id
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

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }
}
