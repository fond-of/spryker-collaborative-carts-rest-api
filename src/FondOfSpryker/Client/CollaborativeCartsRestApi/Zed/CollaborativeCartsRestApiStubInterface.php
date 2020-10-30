<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi\Zed;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface CollaborativeCartsRestApiStubInterface
{
    /**
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByQuoteUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;


}