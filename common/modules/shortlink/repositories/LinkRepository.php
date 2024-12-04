<?php

namespace common\modules\shortlink\repositories;

use common\modules\shortlink\models\Link;

final class LinkRepository
{
    public static function getOne(string $hash): ?Link
    {
        return Link::findOne($hash);
    }

    public static function isExists(string $hash): bool
    {
        return Link::find()
            ->where([
                'hash' => $hash,
            ])
            ->exists();
    }
}
