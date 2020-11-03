<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\Quote\QuoteReader;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\CollaborativeCartsRestApiDependencyProvider;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CollaborativeCartsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Dependency\Facade\CollaborativeCartsRestApiToQuoteFacadeInterface
     */
    protected $collaborativeCartsRestApiToQuoteFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiBusinessFactory
     */
    protected $collaborativeCartsRestApiBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiToQuoteFacadeMock = $this
            ->getMockBuilder(CollaborativeCartsRestApiToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiBusinessFactory = new CollaborativeCartsRestApiBusinessFactory();
        $this->collaborativeCartsRestApiBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CollaborativeCartsRestApiDependencyProvider::FACADE_QUOTE]
            )
            ->willReturnOnConsecutiveCalls(
                $this->collaborativeCartsRestApiToQuoteFacadeMock
            );

        $this->assertInstanceOf(
            QuoteReader::class,
            $this->collaborativeCartsRestApiBusinessFactory->createQuoteReader()
        );
    }
}
