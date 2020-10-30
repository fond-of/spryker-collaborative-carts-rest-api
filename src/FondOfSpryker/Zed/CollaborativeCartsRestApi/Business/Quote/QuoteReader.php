<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote;

use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteReader implements QuoteReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface
     */
    private $quoteFacade;

    /**
     * QuoteReader constructor.
     *
     * @param \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface $quoteFacade
     */
    public function __construct(
        CollaborativeCartsRestApiToQuoteFacadeInterface $quoteFacade
    ) {
        $this->quoteFacade = $quoteFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByQuoteUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->quoteFacade->findQuoteByUuid($quoteTransfer);
    }
}