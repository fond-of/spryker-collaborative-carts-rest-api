<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client;

use Spryker\Client\Quote\QuoteClientInterface;

class CollaborativeCartsRestApiToQuoteClientBridge implements CollaborativeCartsRestApiToQuoteClientInterface
{
    /**
     * @var \Spryker\Client\Quote\QuoteClientInterface
     */
    protected $quoteClient;

    /**
     * CollaborativeCartsRestApiToQuoteClientBridge constructor.
     *
     * @param \Spryker\Client\Quote\QuoteClientInterface $quoteClient
     */
    public function __construct(QuoteClientInterface $quoteClient)
    {
        $this->quoteClient = $quoteClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ClaimCartRequestTransfer $claimCartRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCart(ClaimCartRequestTransfer $claimCartRequestTransfer): ClaimCartResponseTransfer
    {
        return $this->quoteClient->($claimCartRequestTransfer);
    }
}
