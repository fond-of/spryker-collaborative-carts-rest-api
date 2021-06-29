<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Releaser;

use FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\CollaborativeCartsRestApiConfig;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Builder\CollaborativeCartRestResponseBuilderInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestReleaseCartRequestExpanderInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestReleaseCartRequestMapperInterface;
use Generated\Shared\Transfer\RestCollaborativeCartsRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CartReleaser implements CartReleaserInterface
{
    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestReleaseCartRequestMapperInterface
     */
    protected $restReleaseCartRequestMapper;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestReleaseCartRequestExpanderInterface
     */
    protected $restReleaseCartRequestExpander;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Builder\CollaborativeCartRestResponseBuilderInterface
     */
    protected $collaborativeCartRestResponseBuilder;

    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestReleaseCartRequestMapperInterface $restReleaseCartRequestMapper
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestReleaseCartRequestExpanderInterface $restReleaseCartRequestExpander
     * @param \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Builder\CollaborativeCartRestResponseBuilderInterface $collaborativeCartRestResponseBuilder
     * @param \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface $client
     */
    public function __construct(
        RestReleaseCartRequestMapperInterface $restReleaseCartRequestMapper,
        RestReleaseCartRequestExpanderInterface $restReleaseCartRequestExpander,
        CollaborativeCartRestResponseBuilderInterface $collaborativeCartRestResponseBuilder,
        CollaborativeCartsRestApiClientInterface $client
    ) {
        $this->collaborativeCartRestResponseBuilder = $collaborativeCartRestResponseBuilder;
        $this->restReleaseCartRequestMapper = $restReleaseCartRequestMapper;
        $this->restReleaseCartRequestExpander = $restReleaseCartRequestExpander;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCollaborativeCartsRequestAttributesTransfer $restCollaborativeCartsRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function release(
        RestRequestInterface $restRequest,
        RestCollaborativeCartsRequestAttributesTransfer $restCollaborativeCartsRequestAttributesTransfer
    ): RestResponseInterface {
        $restReleaseCartRequestTransfer = $this->restReleaseCartRequestMapper->fromRestCollaborativeCartsRequestAttributes(
            $restCollaborativeCartsRequestAttributesTransfer
        );

        $restReleaseCartRequestTransfer = $this->restReleaseCartRequestExpander->expand(
            $restReleaseCartRequestTransfer,
            $restRequest
        );

        $restReleaseCartResponseTransfer = $this->client->releaseCart($restReleaseCartRequestTransfer);
        $quoteTransfer = $restReleaseCartResponseTransfer->getQuote();

        if ($quoteTransfer === null || $restReleaseCartResponseTransfer->getIsSuccess() === false) {
            return $this->collaborativeCartRestResponseBuilder->createNotReleasedErrorResponse();
        }

        return $this->collaborativeCartRestResponseBuilder->createRestResponse(
            CollaborativeCartsRestApiConfig::ACTION_RELEASE,
            $quoteTransfer
        );
    }
}
