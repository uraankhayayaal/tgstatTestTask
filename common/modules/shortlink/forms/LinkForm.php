<?php

namespace common\modules\shortlink\forms;

use yii\base\Model;

class LinkForm extends Model
{
    /**
     * @var string
     */
    public $url;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            [
                [
                    'url',
                ],
                'required',
            ],
            [
                [
                    'url',
                ],
                'url',
                'message' => 'Не правильный формат ссылки',
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
        ];
    }

    /**
     * @return array<string,string>
     */
    public static function labels(): array
    {
        return (new self())->attributeLabels();
    }
}
