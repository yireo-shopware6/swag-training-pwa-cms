<?php declare(strict_types=1);

namespace SwagTraining\PwaCms\Config;

use Shopware\Core\Framework\Struct\Struct;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class Config extends Struct
{
    protected string $cmsPageUuid = '';

    public function __construct(
        SystemConfigService $systemConfigService
    ) {
        $config = $systemConfigService->get('SwagTrainingPwaCms');
        $this->cmsPageUuid = $config['config']['cmsPageUuid'];
    }

    public function getCmsPageUuid(): string
    {
        return $this->cmsPageUuid;
    }
}
