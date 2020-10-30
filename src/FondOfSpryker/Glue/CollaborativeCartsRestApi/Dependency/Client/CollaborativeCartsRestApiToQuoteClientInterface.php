<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client;

interface CollaborativeCartsRestApiToQuoteClientInterface
{

    public function claimCart(ClaimCartRequestTransfer $claimCartRequestTransfer): ClaimCartResponseTransfer;
}
