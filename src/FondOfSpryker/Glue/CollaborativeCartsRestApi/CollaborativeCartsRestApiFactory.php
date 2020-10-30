<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi;

use FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart\CollaborativeCartCreator;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart\CollaborativeCartCreatorInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\CollaborativeCartMapper;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\CollaborativeCartMapperInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilder;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface;
use FondOfSpryker\Zed\CollaborativeCart\CollaborativeCartDependencyProvider;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface getClient()
 */
class CollaborativeCartsRestApiFactory extends AbstractFactory
{

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart\CollaborativeCartCreatorInterface
     */
    public function createCollaborativeCartCreator(): CollaborativeCartCreatorInterface
    {
        return new CollaborativeCartCreator(
            $this->getClient(),
            $this->getCollaborativeCartClient(),
            $this->createCollaborativeCartRestResponseBuilder()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface
     *
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getCollaborativeCartClient(): CollaborativeCartsRestApiToCollaborativeCartClientInterface
    {
        return $this->getProvidedDependency(CollaborativeCartsRestApiDependencyProvider::CLIENT_COLLABORATIVE_CART);
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface
     */
    public function createCollaborativeCartRestResponseBuilder(): CollaborativeCartRestResponseBuilderInterface
    {
        return new CollaborativeCartRestResponseBuilder(
            $this->getResourceBuilder(),
            $this->createCollaborativeCartMapper()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\CollaborativeCartMapperInterface
     *
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createCollaborativeCartMapper(): CollaborativeCartMapperInterface
    {
        return new CollaborativeCartMapper();
    }
}
