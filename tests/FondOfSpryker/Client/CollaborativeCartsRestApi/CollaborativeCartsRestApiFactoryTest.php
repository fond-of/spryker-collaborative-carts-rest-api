<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStub;
use FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStubInterface;
use Spryker\Client\Kernel\Container;

class CollaborativeCartsRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiFactory
     */
    protected $collaborativeCartsRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CollaborativeCartsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiFactory = new CollaborativeCartsRestApiFactory();
        $this->collaborativeCartsRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCollaborativeCartsRestApiStub(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CollaborativeCartsRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        $this->assertInstanceOf(
            CollaborativeCartsRestApiStub::class,
            $this->collaborativeCartsRestApiFactory->createCollaborativeCartsRestApiStub()
        );
    }
}
