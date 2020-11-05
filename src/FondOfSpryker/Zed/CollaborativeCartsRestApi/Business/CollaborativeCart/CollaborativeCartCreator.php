<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCart;

use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeInterface;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface;
use Generated\Shared\Transfer\ClaimCartRequestTransfer;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;

class CollaborativeCartCreator implements CollaborativeCartCreatorInterface
{
    protected const ERROR_MESSAGE_COLLABORATIVE_CART_NOT_FOUND = 'Could not find quote to claim.';

    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeInterface
     */
    protected $collaborativeCartFacade;

    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @param \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToCollaborativeCartFacadeInterface $collaborativeCartFacade
     * @param \FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface $quoteFacade
     */
    public function __construct(
        CollaborativeCartsRestApiToCollaborativeCartFacadeInterface $collaborativeCartFacade,
        CollaborativeCartsRestApiToQuoteFacadeInterface $quoteFacade
    ) {
        $this->collaborativeCartFacade = $collaborativeCartFacade;
        $this->quoteFacade = $quoteFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    public function claimCart(
        RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
    ): ClaimCartResponseTransfer {

        $quoteResponseTransfer = $this->getQuote($restCollaborativeCartRequestAttributesTransfer);

        if ($quoteResponseTransfer->getIsSuccessful() === false) {
            return (new ClaimCartResponseTransfer())
                ->setIsSuccess(false)
                ->setError(self::ERROR_MESSAGE_COLLABORATIVE_CART_NOT_FOUND);
        }

        $claimCartRequestTransfer = $this->createClaimCartRequestTransfer(
            $restCollaborativeCartRequestAttributesTransfer,
            $quoteResponseTransfer->getQuoteTransfer()
        );

        return $this->collaborativeCartFacade->claimCart($claimCartRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ClaimCartRequestTransfer
     */
    protected function createClaimCartRequestTransfer(
        RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer,
        QuoteTransfer $quoteTransfer
    ): ClaimCartRequestTransfer {
        return (new ClaimCartRequestTransfer())
            ->setNewIdCustomer($restCollaborativeCartRequestAttributesTransfer->getNewIdCustomer())
            ->setNewCustomerReference($restCollaborativeCartRequestAttributesTransfer->getNewCustomerReference())
            ->setIdQuote($quoteTransfer->getIdQuote());
    }

    /**
     * @param \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected function getQuote(
        RestCollaborativeCartRequestAttributesTransfer $restCollaborativeCartRequestAttributesTransfer
    ): QuoteResponseTransfer {

        return $this->quoteFacade
            ->findQuoteByUuid($restCollaborativeCartRequestAttributesTransfer->getQuote());
    }
}
