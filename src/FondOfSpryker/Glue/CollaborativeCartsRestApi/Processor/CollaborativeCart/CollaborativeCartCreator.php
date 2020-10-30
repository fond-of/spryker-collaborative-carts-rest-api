<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart;

use FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface;
use Generated\Shared\Transfer\ClaimCartRequestTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CollaborativeCartCreator implements CollaborativeCartCreatorInterface
{
    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface
     */
    protected $collaborativeCartClient;

    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface
     */
    protected $collaborativeCartsRestApiClient;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface
     */
    protected $collaborativeCartRestResponseBuilder;

    /**
     * CollaborativeCartCreator constructor.
     *
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface $collaborativeCartsRestApiClient
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientInterface $collaborativeCartClient
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface $collaborativeCartRestResponseBuilder
     */
    public function __construct(
        CollaborativeCartsRestApiClientInterface $collaborativeCartsRestApiClient,
        CollaborativeCartsRestApiToCollaborativeCartClientInterface $collaborativeCartClient,
        CollaborativeCartRestResponseBuilderInterface $collaborativeCartRestResponseBuilder
    ) {
        $this->collaborativeCartClient = $collaborativeCartClient;
        $this->collaborativeCartsRestApiClient = $collaborativeCartsRestApiClient;
        $this->collaborativeCartRestResponseBuilder = $collaborativeCartRestResponseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     *
     * @throws \Exception
     */
    public function create(
        RestRequestInterface $restRequest,
        RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
    ): RestResponseInterface{

        if ($restCollaborativeCartsAttributesTransfer->getCartId() === null) {
            return $this->collaborativeCartRestResponseBuilder
                ->createMissingCartIdErrorResponse();
        }

        $quoteResponseTransfer = $this->collaborativeCartsRestApiClient
            ->findQuoteByQuoteUuid(
                (new QuoteTransfer())->setUuid($restCollaborativeCartsAttributesTransfer->getCartId())
            );

        if ($quoteResponseTransfer->getIsSuccessful() === false) {
            return $this->collaborativeCartRestResponseBuilder
                ->createCollaborativeCartRestErrorResponse($quoteResponseTransfer->getErrors());
        }

        $claimCartRequestTransfer = (new ClaimCartRequestTransfer())
            ->setIdQuote($quoteResponseTransfer->getQuoteTransfer()->getIdQuote())
            ->setNewIdCustomer($restRequest->getRestUser()->getSurrogateIdentifier())
            ->setNewCustomerReference($restRequest->getRestUser()->getNaturalIdentifier());
        $claimCartResponseTransfer = $this->collaborativeCartClient->claimCart($claimCartRequestTransfer);

        if ($claimCartResponseTransfer->getIsSuccess() === false) {
            return $this->collaborativeCartRestResponseBuilder
                ->createCollaborativeCartRestErrorResponse($claimCartResponseTransfer->getError());
        }

        return $this->collaborativeCartRestResponseBuilder
            ->createCollaborativeCartRestResponse(
                $claimCartResponseTransfer->getQuote(),
                $restCollaborativeCartsAttributesTransfer->getAction()
            );
    }
}