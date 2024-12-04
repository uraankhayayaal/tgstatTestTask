<?php

namespace common\modules\shortlink\services;

use common\modules\shortlink\forms\LinkForm;
use common\modules\shortlink\models\Link;
use common\modules\shortlink\repositories\LinkRepository;
use common\modules\shortlink\services\interfaces\ShortlinkServiceInterface;
use Yii;
use yii\web\HttpException;

final class ShortlinkService implements ShortlinkServiceInterface
{
    public const HASH_LENGHT = 5;

    public function short(LinkForm $linkForm): ?Link
    {
        $link = new Link();

        $link->setAttributes([
            ...$linkForm->attributes,
            'hash' => $this->buildHash(),
        ]);

        if ($link->save()) {
            return $link;
        }

        throw new HttpException(500, json_encode($link->errors));
    }

    public function getOne(string $hash): ?Link
    {
        $model = LinkRepository::getOne($hash);

        if ($model === null) {
            throw new HttpException(404);
        }

        return $model;
    }

    private function buildHash(): string
    {
        $hash = Yii::$app->getSecurity()->generateRandomString(self::HASH_LENGHT);

        $isExists = LinkRepository::isExists($hash);

        if ($isExists) {
            return $this->buildHash();
        }

        return $hash;
    }
}
