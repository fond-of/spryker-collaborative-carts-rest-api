<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiBusinessFactory getFactory()
 */
class CollaborativeCartsRestApiFacade extends AbstractFacade implements CollaborativeCartsRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function findQuoteByQuotetUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->getFactory()
            ->createQuoteReader()
            ->findQuoteByQuoteUuid($quoteTransfer);
    }

}

