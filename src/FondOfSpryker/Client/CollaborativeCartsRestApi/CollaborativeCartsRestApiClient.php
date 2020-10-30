<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiFactory getFactory()
 */
class CollaborativeCartsRestApiClient extends AbstractClient implements CollaborativeCartsRestApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByQuoteUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->getFactory()->createCollaborativeCartsRestApiStub()->findQuoteByQuoteUuid($quoteTransfer);
    }

}