<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCart\CollaborativeCartCreator;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCart\CollaborativeCartCreatorInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\CollaborativeCartsRestApiDependencyProvider;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CollaborativeCartsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCart\CollaborativeCartCreatorInterface
     */
    public function createCollaborativeCartCreator(): CollaborativeCartCreatorInterface
    {
        return new CollaborativeCartCreator(
            $this->getCollaborativeCartFacade(),
            $this->getQuoteFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface
     */
    public function getQuoteFacade(): CollaborativeCartsRestApiToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(CollaborativeCartsRestApiDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeInterface
     */
    public function getCollaborativeCartFacade(): CollaborativeCartsRestApiToCollaborativeCartFacadeInterface
    {
        return $this->getProvidedDependency(CollaborativeCartsRestApiDependencyProvider::FACADE_COLLABORATIVE_CART);
    }
}
