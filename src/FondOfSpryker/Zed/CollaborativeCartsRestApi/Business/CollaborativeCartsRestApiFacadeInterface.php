<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;

interface CollaborativeCartsRestApiFacadeInterface
{
    /**
     * Specification:
     * - take over the Cart
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCart(
        RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
    ): ClaimCartResponseTransfer;
}
