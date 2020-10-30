<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi;

use FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStub;
use FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CollaborativeCartsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStubInterface
     *
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createCollaborativeCartsRestApiStub(): CollaborativeCartsRestApiStubInterface
    {
        return new CollaborativeCartsRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface
     *
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getZedRequestClient(): CollaborativeCartsRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CollaborativeCartsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}