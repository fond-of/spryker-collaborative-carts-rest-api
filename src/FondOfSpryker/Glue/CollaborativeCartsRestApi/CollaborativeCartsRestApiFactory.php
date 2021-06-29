<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi;

use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Builder\CollaborativeCartRestResponseBuilder;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Builder\CollaborativeCartRestResponseBuilderInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Claimer\CartClaimer;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Claimer\CartClaimerInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart\CollaborativeCartProcessor;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart\CollaborativeCartProcessorInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestClaimCartRequestExpander;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestClaimCartRequestExpanderInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestReleaseCartRequestExpander;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestReleaseCartRequestExpanderInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Filter\RestCustomerFilter;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Filter\RestCustomerFilterInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestClaimCartRequestMapper;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestClaimCartRequestMapperInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestCollaborativeCartsResponseAttributesMapper;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestCollaborativeCartsResponseAttributesMapperInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestReleaseCartRequestMapper;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestReleaseCartRequestMapperInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Releaser\CartReleaser;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Releaser\CartReleaserInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClientInterface getClient()
 */
class CollaborativeCartsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\CollaborativeCart\CollaborativeCartProcessorInterface
     */
    public function createCollaborativeCartProcessor(): CollaborativeCartProcessorInterface
    {
        return new CollaborativeCartProcessor(
            $this->createCollaborativeCartRestResponseBuilder(),
            $this->createCartClaimer(),
            $this->createCartReleaser()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Builder\CollaborativeCartRestResponseBuilderInterface
     */
    protected function createCollaborativeCartRestResponseBuilder(): CollaborativeCartRestResponseBuilderInterface
    {
        return new CollaborativeCartRestResponseBuilder(
            $this->getResourceBuilder(),
            $this->createRestCollaborativeCartsResponseAttributesMapper()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestCollaborativeCartsResponseAttributesMapperInterface
     */
    protected function createRestCollaborativeCartsResponseAttributesMapper(): RestCollaborativeCartsResponseAttributesMapperInterface
    {
        return new RestCollaborativeCartsResponseAttributesMapper();
    }

    protected function createCartClaimer(): CartClaimerInterface
    {
        return new CartClaimer(
            $this->createRestClaimCartRequestMapper(),
            $this->createRestClaimCartRequestExpander(),
            $this->createCollaborativeCartRestResponseBuilder(),
            $this->getClient()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestClaimCartRequestMapperInterface
     */
    protected function createRestClaimCartRequestMapper(): RestClaimCartRequestMapperInterface
    {
        return new RestClaimCartRequestMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestClaimCartRequestExpanderInterface
     */
    protected function createRestClaimCartRequestExpander(): RestClaimCartRequestExpanderInterface
    {
        return new RestClaimCartRequestExpander($this->createRestCustomerFilter());
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Filter\RestCustomerFilterInterface
     */
    protected function createRestCustomerFilter(): RestCustomerFilterInterface
    {
        return new RestCustomerFilter();
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Releaser\CartReleaserInterface
     */
    protected function createCartReleaser(): CartReleaserInterface
    {
        return new CartReleaser(
            $this->createRestReleaseCartRequestMapper(),
            $this->createRestReleaseCartRequestExpander(),
            $this->createCollaborativeCartRestResponseBuilder(),
            $this->getClient()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Mapper\RestReleaseCartRequestMapperInterface
     */
    protected function createRestReleaseCartRequestMapper(): RestReleaseCartRequestMapperInterface
    {
        return new RestReleaseCartRequestMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\CollaborativeCartsRestApi\Processor\Expander\RestReleaseCartRequestExpanderInterface
     */
    protected function createRestReleaseCartRequestExpander(): RestReleaseCartRequestExpanderInterface
    {
        return new RestReleaseCartRequestExpander($this->createRestCustomerFilter());
    }
}
