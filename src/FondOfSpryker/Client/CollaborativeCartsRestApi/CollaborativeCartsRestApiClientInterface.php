<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi;

use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;

interface CollaborativeCartsRestApiClientInterface
{
    /**
     * Specification:
     * - take over the cart
     * - Makes Zed request.
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
