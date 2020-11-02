<?php

namespace FondOfSpryker\Glue\CollaborativeCartsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CollaborativeCart\CollaborativeCartClientInterface;
use FondOfSpryker\Glue\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToCollaborativeCartClientBridge;
use Spryker\Glue\Kernel\Container;
use Spryker\Glue\Kernel\Locator;
use Spryker\Shared\Kernel\BundleProxy;

class CollaborativeCartsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CollaborativeCart\CollaborativeCartClientInterface
     */
    protected $collaborativeCartClientMock;

    /**
     * @var \FondOfSpryker\Glue\CollaborativeCartsRestApi\CollaborativeCartsRestApiDependencyProvider
     */
    protected $collaborativeCartsRestApiDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartClientMock = $this->getMockBuilder(CollaborativeCartClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiDependencyProvider = new CollaborativeCartsRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(self::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(self::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['collaborativeCart'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(self::atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturnOnConsecutiveCalls(
                $this->collaborativeCartClientMock
            );

        $container = $this->collaborativeCartsRestApiDependencyProvider->provideDependencies(
            $this->containerMock
        );

        self::assertEquals($this->containerMock, $container);

        self::assertInstanceOf(
            CollaborativeCartsRestApiToCollaborativeCartClientBridge::class,
            $container[CollaborativeCartsRestApiDependencyProvider::CLIENT_COLLABORATIVE_CART]
        );
    }
}
