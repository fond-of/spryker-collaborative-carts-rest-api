<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi;

use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfSpryker\Zed\CollaborativeCartsRestApi\CollaborativeCartsRestApiConfig getConfig()
 */
class CollaborativeCartsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_QUOTE = 'FACADE_QUOTE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addQuoteFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addQuoteFacade(Container $container): Container
    {
        $container->set(static::FACADE_QUOTE, function (Container $container) {
            return new CollaborativeCartsRestApiToQuoteFacadeBridge(
                $container->getLocator()->quote()->facade()
            );
        });

        return $container;
    }

}
