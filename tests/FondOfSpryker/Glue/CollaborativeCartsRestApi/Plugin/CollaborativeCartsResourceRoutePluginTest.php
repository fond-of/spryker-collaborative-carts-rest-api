<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\CollaborativeCartsRestApiConfig;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Plugin\GlueApplication\CollaborativeCartsResourceRoutePlugin;
use Generated\Shared\Transfer\RestCollaborativeCartsAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class CollaborativeCartsResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionMock;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\Plugin\GlueApplication\CollaborativeCartsResourceRoutePlugin
     */
    protected $collaborativeCartsResourceRoutePlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsResourceRoutePlugin = new CollaborativeCartsResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        self::assertEquals(
            CollaborativeCartsRestApiConfig::RESOURCE_COLLABORATIVE_CARTS,
            $this->collaborativeCartsResourceRoutePlugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->expects(self::atLeastOnce())
            ->method('addPost')
            ->with('post')
            ->willReturn($this->resourceRouteCollectionMock);

        self::assertEquals(
            $this->resourceRouteCollectionMock,
            $this->collaborativeCartsResourceRoutePlugin->configure($this->resourceRouteCollectionMock)
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        self::assertEquals(
            CollaborativeCartsRestApiConfig::CONTROLLER_COLLABORATIVE_CARTS,
            $this->collaborativeCartsResourceRoutePlugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        self::assertEquals(
            RestCollaborativeCartsAttributesTransfer::class,
            $this->collaborativeCartsResourceRoutePlugin->getResourceAttributesClassName()
        );
    }
}
