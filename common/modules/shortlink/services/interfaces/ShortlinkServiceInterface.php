<?php

namespace common\modules\shortlink\services\interfaces;

use common\modules\shortlink\forms\LinkForm;
use common\modules\shortlink\models\Link;

interface ShortlinkServiceInterface
{
    public function short(LinkForm $linkForm): ?Link;

    public function getOne(string $hash): ?Link;
}
