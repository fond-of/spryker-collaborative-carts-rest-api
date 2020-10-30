<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi\Zed;

use FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CollaborativeCartsRestApiStub implements CollaborativeCartsRestApiStubInterface
{
    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * CollaborativeCartsRestApiStub constructor.
     *
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CollaborativeCartsRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByQuoteUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\QuoteResponseTransfer $quoteResponseTransfer */
        $quoteResponseTransfer = $this->zedRequestClient->call(
            '/collaborative-carts-rest-api/gateway/find-quote-by-quote-uuid',
            $quoteTransfer
        );

        return $quoteResponseTransfer;
    }

}