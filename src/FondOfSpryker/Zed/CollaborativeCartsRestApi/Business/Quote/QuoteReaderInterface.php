<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByQuoteUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;
}