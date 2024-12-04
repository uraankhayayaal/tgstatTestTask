<?php

namespace common\modules\shortlink\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "links".
 *
 * @property string $hash
 * @property string $url
 * @property int $created_at
 * @property int $updated_at
 */
class Link extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function tableName()
    {
        return 'links';
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            [
                [
                    'url',
                    'hash',
                ],
                'required',
            ],
            [
                [
                    'url',
                ],
                'url',
            ],
            [
                [
                    'hash',
                ],
                'string',
                'max' => 5,
            ],
            [
                'hash',
                'match',
                'pattern' => '/^[A-Za-z0-9_-]\w*$/i',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Ссылка',
            'hash' => 'Хэш',
        ];
    }
}
