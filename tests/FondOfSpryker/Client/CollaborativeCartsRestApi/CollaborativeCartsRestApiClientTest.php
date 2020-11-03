<?php

namespace FondOfSpryker\Client\CollaborativeCartsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStubInterface;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CollaborativeCartsRestApiClientTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiClient
     */
    protected $collaborativeCartsRestApiClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CollaborativeCartsRestApi\CollaborativeCartsRestApiFactory
     */
    protected $collaborativeCartsRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CollaborativeCartsRestApi\Zed\CollaborativeCartsRestApiStubInterface
     */
    protected $collaborativeCartsRestApiStubMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->collaborativeCartsRestApiFactoryMock = $this->getMockBuilder(CollaborativeCartsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiStubMock = $this->getMockBuilder(CollaborativeCartsRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiClient = new CollaborativeCartsRestApiClient();
        $this->collaborativeCartsRestApiClient->setFactory($this->collaborativeCartsRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindQuoteByQuoteUuid(): void
    {
        $this->collaborativeCartsRestApiFactoryMock->expects(self::atLeastOnce())
            ->method('createCollaborativeCartsRestApiStub')
            ->willReturn($this->collaborativeCartsRestApiStubMock);

        $this->collaborativeCartsRestApiStubMock->expects(self::atLeastOnce())
            ->method('findQuoteByQuoteUuid')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $quoteResponseTransfer = $this->collaborativeCartsRestApiClient->findQuoteByQuoteUuid(
            $this->quoteTransferMock
        );

        $this->assertInstanceOf(
            QuoteResponseTransfer::class,
            $quoteResponseTransfer
        );

        $this->assertEquals(
            $this->quoteResponseTransferMock,
            $quoteResponseTransfer
        );
    }
}
