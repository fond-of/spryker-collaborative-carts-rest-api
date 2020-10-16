<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi;

use FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;

class CollaborativeCartsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_COLLABORATIVE_CART = 'CLIENT_COLLABORATIVE_CART';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addCollaborativeCartClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCollaborativeCartClient(Container $container): Container
    {
        $container[static::CLIENT_COLLABORATIVE_CART] = function (Container $container) {
            return new CollaborativeCartsRestApiToCollaborativeCartClientBridge(
                $container->getLocator()->collaborativeCart()->client()
            );
        };

        return $container;
    }
}
