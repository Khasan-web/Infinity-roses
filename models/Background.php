<?php

namespace app\models;

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

}
