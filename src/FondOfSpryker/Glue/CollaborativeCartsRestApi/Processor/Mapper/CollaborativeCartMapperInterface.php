<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;

interface CollaborativeCartMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer
     */
    public function mapQuoteTransferToResCollaborativeCartsAttributes(
        QuoteTransfer $quoteTransfer
    ): RestCollaborativeCartsAttributesTransfer;
}
