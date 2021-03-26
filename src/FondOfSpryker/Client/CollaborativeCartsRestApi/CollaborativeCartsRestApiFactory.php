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
     */
    public function createCollaborativeCartsRestApiStub(): CollaborativeCartsRestApiStubInterface
    {
        return new CollaborativeCartsRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CollaborativeCartsRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CollaborativeCartsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
