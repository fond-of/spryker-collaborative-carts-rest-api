<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart;

use FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CollaborativeCartCreator implements CollaborativeCartCreatorInterface
{
    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface
     */
    protected $collaborativeCartsRestApiClient;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface
     */
    protected $collaborativeCartRestResponseBuilder;

    /**
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface $collaborativeCartsRestApiClient
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\RestResponseBuilder\CollaborativeCartRestResponseBuilderInterface $collaborativeCartRestResponseBuilder
     */
    public function __construct(
        CollaborativeCartsRestApiClientInterface $collaborativeCartsRestApiClient,
        CollaborativeCartRestResponseBuilderInterface $collaborativeCartRestResponseBuilder
    ) {
        $this->collaborativeCartsRestApiClient = $collaborativeCartsRestApiClient;
        $this->collaborativeCartRestResponseBuilder = $collaborativeCartRestResponseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function create(
        RestRequestInterface $restRequest,
        RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
    ): RestResponseInterface {

        if ($restCollaborativeCartsAttributesTransfer->getCartId() === null) {
            return $this->collaborativeCartRestResponseBuilder
                ->createMissingCartIdErrorResponse();
        }

        $restCollaborativeCartRequestAttributesTransfer = $this
            ->createRestCollaborativeCartRequestAttributesTransfer(
                $restRequest,
                $restCollaborativeCartsAttributesTransfer
            );

        $claimCartResponseTransfer = $this->collaborativeCartsRestApiClient
            ->claimCart($restCollaborativeCartRequestAttributesTransfer);

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

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer
     */
    protected function createRestCollaborativeCartRequestAttributesTransfer(
        RestRequestInterface $restRequest,
        RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
    ): RestCollaborativeCartRequestAttributesTransfer {
        return (new RestCollaborativeCartRequestAttributesTransfer())
            ->setNewIdCustomer($restRequest->getRestUser()->getSurrogateIdentifier())
            ->setNewCustomerReference($restRequest->getRestUser()->getNaturalIdentifier())
            ->setQuote($this->createQuoteTransfer($restCollaborativeCartsAttributesTransfer));
    }

    /**
     * @param \Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function createQuoteTransfer(
        RestCollaborativeCartsAttributesTransfer $restCollaborativeCartsAttributesTransfer
    ): QuoteTransfer {
        return (new QuoteTransfer())
            ->setUuid($restCollaborativeCartsAttributesTransfer->getCartId());
    }
}
