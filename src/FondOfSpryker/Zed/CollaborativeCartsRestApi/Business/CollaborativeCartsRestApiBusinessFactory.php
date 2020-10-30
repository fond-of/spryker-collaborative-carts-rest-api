<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote\QuoteReader;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote\QuoteReaderInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\CollaborativeCartsRestApiDependencyProvider;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CollaborativeCartsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote\QuoteReaderInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createQuoteReader(): QuoteReaderInterface
    {
        return new QuoteReader(
            $this->getQuoteFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getQuoteFacade(): CollaborativeCartsRestApiToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(CollaborativeCartsRestApiDependencyProvider::FACADE_QUOTE);
    }

}