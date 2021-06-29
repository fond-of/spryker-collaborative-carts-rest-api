<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Claimer;

use FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\CollaborativeCartsRestApiConfig;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Builder\CollaborativeCartRestResponseBuilderInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestClaimCartRequestExpanderInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestClaimCartRequestMapperInterface;
use Generated\Shared\Transfer\RestCollaborativeCartsRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CartClaimer implements CartClaimerInterface
{
    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestClaimCartRequestMapperInterface
     */
    protected $restClaimCartRequestMapper;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestClaimCartRequestExpanderInterface
     */
    protected $restClaimCartRequestExpander;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Builder\CollaborativeCartRestResponseBuilderInterface
     */
    protected $collaborativeCartRestResponseBuilder;

    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestClaimCartRequestMapperInterface $restClaimCartRequestMapper
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestClaimCartRequestExpanderInterface $restClaimCartRequestExpander
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Builder\CollaborativeCartRestResponseBuilderInterface $collaborativeCartRestResponseBuilder
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface $client
     */
    public function __construct(
        RestClaimCartRequestMapperInterface $restClaimCartRequestMapper,
        RestClaimCartRequestExpanderInterface $restClaimCartRequestExpander,
        CollaborativeCartRestResponseBuilderInterface $collaborativeCartRestResponseBuilder,
        CollaborativeCartsRestApiClientInterface $client
    ) {
        $this->collaborativeCartRestResponseBuilder = $collaborativeCartRestResponseBuilder;
        $this->restClaimCartRequestMapper = $restClaimCartRequestMapper;
        $this->restClaimCartRequestExpander = $restClaimCartRequestExpander;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCollaborativeCartsRequestAttributesTransfer $restCollaborativeCartsRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function claim(
        RestRequestInterface $restRequest,
        RestCollaborativeCartsRequestAttributesTransfer $restCollaborativeCartsRequestAttributesTransfer
    ): RestResponseInterface {
        $restClaimCartRequestTransfer = $this->restClaimCartRequestMapper->fromRestCollaborativeCartsRequestAttributes(
            $restCollaborativeCartsRequestAttributesTransfer
        );

        $restClaimCartRequestTransfer = $this->restClaimCartRequestExpander->expand(
            $restClaimCartRequestTransfer,
            $restRequest
        );

        $restClaimCartResponseTransfer = $this->client->claimCart($restClaimCartRequestTransfer);
        $quoteTransfer = $restClaimCartResponseTransfer->getQuote();

        if ($quoteTransfer === null || $restClaimCartResponseTransfer->getIsSuccess() === false) {
            return $this->collaborativeCartRestResponseBuilder->createNotClaimedErrorResponse();
        }

        return $this->collaborativeCartRestResponseBuilder->createRestResponse(
            CollaborativeCartsRestApiConfig::ACTION_CLAIM,
            $quoteTransfer
        );
    }
}
