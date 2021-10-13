<?php declare(strict_types=1);

namespace SwagTraining\PwaCms\Decorator;

use Shopware\Core\System\SalesChannel\Context\AbstractSalesChannelContextFactory;
use Shopware\Core\System\SalesChannel\Context\SalesChannelContextFactory;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use SwagTraining\PwaCms\Config\Config;

class ExtendedSalesChannelContextFactory extends SalesChannelContextFactory
{
    /**
     * @var Config
     */
    private Config $config;

    /**
     * @var SalesChannelContextFactory
     */
    private SalesChannelContextFactory $salesChannelContextFactory;

    public function __construct(
        SalesChannelContextFactory $salesChannelContextFactory,
        Config $config
    ) {
        $this->salesChannelContextFactory = $salesChannelContextFactory;
        $this->config = $config;
    }

    /**
     * @param string $token
     * @param string $salesChannelId
     * @param array $options
     * @return SalesChannelContext
     */
    public function create(string $token, string $salesChannelId, array $options = []): SalesChannelContext
    {
        $salesChannelContext = $this->salesChannelContextFactory->create($token, $salesChannelId, $options);
        $salesChannelContext->addExtension('swagTrainingPwaCmsConfig', $this->config);
        return $salesChannelContext;
    }

    /**
     * @return AbstractSalesChannelContextFactory
     */
    public function getDecorated(): AbstractSalesChannelContextFactory
    {
        return $this->salesChannelContextFactory;
    }
}
