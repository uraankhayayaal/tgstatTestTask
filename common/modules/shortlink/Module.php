<?php

namespace common\modules\shortlink;

use common\base\modules\BaseModule;
use common\modules\shortlink\services\ShortlinkService;
use common\modules\shortlink\services\interfaces\ShortlinkServiceInterface;

class Module extends BaseModule
{
    protected function bindServices(): void
    {
        $this->getContainer()->set(ShortlinkServiceInterface::class, ShortlinkService::class);
    }
}
