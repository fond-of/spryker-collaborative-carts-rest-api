<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade;

use Generated\Shared\Transfer\ClaimCartRequestTransfer;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;

interface CollaborativeCartsRestApiToCollaborativeCartFacadeInterface
{
    /**
     * Specifications:
     * - Claim cart by ClaimCartRequestTransfer
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ClaimCartRequestTransfer $claimCartRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCart(ClaimCartRequestTransfer $claimCartRequestTransfer): ClaimCartResponseTransfer;
}
