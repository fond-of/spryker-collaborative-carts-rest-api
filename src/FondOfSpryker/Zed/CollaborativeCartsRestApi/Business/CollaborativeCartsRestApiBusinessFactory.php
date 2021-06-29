<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Claimer\CartClaimer;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Claimer\CartClaimerInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Mapper\ClaimCartRequestMapper;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Mapper\ClaimCartRequestMapperInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Mapper\ReleaseCartRequestMapper;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Mapper\ReleaseCartRequestMapperInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Reader\QuoteReader;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Reader\QuoteReaderInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Releaser\CartReleaser;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Releaser\CartReleaserInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\CollaborativeCartsRestApiDependencyProvider;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CollaborativeCartsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Claimer\CartClaimerInterface
     */
    public function createCartClaimer(): CartClaimerInterface
    {
        return new CartClaimer(
            $this->createQuoteReader(),
            $this->createClaimCartRequestMapper(),
            $this->getCollaborativeCartFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Releaser\CartReleaserInterface
     */
    public function createCartReleaser(): CartReleaserInterface
    {
        return new CartReleaser(
            $this->createQuoteReader(),
            $this->createReleaseCartRequestMapper(),
            $this->getCollaborativeCartFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Reader\QuoteReaderInterface
     */
    protected function createQuoteReader(): QuoteReaderInterface
    {
        return new QuoteReader(
            $this->getQuoteFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Mapper\ClaimCartRequestMapperInterface
     */
    protected function createClaimCartRequestMapper(): ClaimCartRequestMapperInterface
    {
        return new ClaimCartRequestMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Mapper\ReleaseCartRequestMapperInterface
     */
    protected function createReleaseCartRequestMapper(): ReleaseCartRequestMapperInterface
    {
        return new ReleaseCartRequestMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface
     */
    protected function getQuoteFacade(): CollaborativeCartsRestApiToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(CollaborativeCartsRestApiDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeInterface
     */
    protected function getCollaborativeCartFacade(): CollaborativeCartsRestApiToCollaborativeCartFacadeInterface
    {
        return $this->getProvidedDependency(CollaborativeCartsRestApiDependencyProvider::FACADE_COLLABORATIVE_CART);
    }
}
