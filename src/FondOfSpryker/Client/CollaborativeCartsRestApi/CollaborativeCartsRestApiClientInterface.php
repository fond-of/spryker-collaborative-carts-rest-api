<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface CollaborativeCartsRestApiClientInterface
{
    /**
     * Specification:
     * - Finds cart id by cart UUID.
     * - Makes Zed request.
     *
     * @api
     *
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByQuoteUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;
}