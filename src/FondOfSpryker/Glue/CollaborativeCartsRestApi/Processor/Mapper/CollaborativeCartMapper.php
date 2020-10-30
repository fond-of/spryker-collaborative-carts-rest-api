<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;

class CollaborativeCartMapper implements CollaborativeCartMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @return \Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer
     */
    public function mapQuoteTransferToResCollaborativeCartsAttributes(
        QuoteTransfer $quoteTransfer
    ): RestCollaborativeCartsAttributesTransfer {

        return (new RestCollaborativeCartsAttributesTransfer())
            ->setCartId($quoteTransfer->getIdQuote())
            ->setCustomerReference($quoteTransfer->getCustomer()->getCustomerReference())
            ->setOriginalCustomerReference($quoteTransfer->getOriginalCustomerReference())
            ->setCompanyUserReference($quoteTransfer->getCompanyUserReference())
            ->setOriginalCompanyReference($quoteTransfer->getOriginalCompanyUserReference());
    }

}