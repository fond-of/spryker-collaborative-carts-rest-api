<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiFacade;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiFacade
     */
    protected $collaborativeCartsRestApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->collaborativeCartsRestApiFacadeMock = $this->getMockBuilder(CollaborativeCartsRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->collaborativeCartsRestApiFacadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $facade;

            public function __construct(AbstractFacade $facade)
            {
                $this->facade = $facade;
            }

            protected function getFacade(): AbstractFacade
            {
                return $this->facade;
            }
        };
    }

    /**
     * @return void
     */
    public function testFindQuoteByQuoteUuidAction(): void
    {
        $this->collaborativeCartsRestApiFacadeMock->expects(self::atLeastOnce())
            ->method('findQuoteByQuotetUuid')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $quoteResponseTransfer = $this->gatewayController->findQuoteByQuoteUuidAction(
            $this->quoteTransferMock
        );

        $this->assertInstanceOf(
            QuoteResponseTransfer::class,
            $this->quoteResponseTransferMock
        );

        $this::assertEquals(
            $this->quoteResponseTransferMock,
            $quoteResponseTransfer
        );
    }
}
