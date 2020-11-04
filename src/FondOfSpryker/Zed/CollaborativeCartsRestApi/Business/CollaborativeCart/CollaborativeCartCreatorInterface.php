<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCart;

use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;

interface CollaborativeCartCreatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCart(
        RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
    ): ClaimCartResponseTransfer;
}
