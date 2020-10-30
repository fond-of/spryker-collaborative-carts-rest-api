<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface CollaborativeCartsRestApiFacadeInterface
{
    /**
     * Specification:
     * - Finds quote by quote's UUID.
     *
     * @api
     *
     * @param \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\QuoteTransfer $quoteTransfer
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByQuotetUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;

}

