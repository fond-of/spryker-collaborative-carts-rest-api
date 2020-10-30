<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Communication\Controller;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiFacade getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByQuoteUuidAction(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->getFacade()->findQuoteByQuotetUuid($quoteTransfer);
    }


}