<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiFacade;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiFacade
     */
    protected $collaborativeCartsRestApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer
     */
    protected $restCollaborativeCartRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    protected $claimCartResponseTransferMock;

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

        $this->restCollaborativeCartRequestAttributesTransferMock = $this->getMockBuilder(RestCollaborativeCartRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->claimCartResponseTransferMock = $this->getMockBuilder(ClaimCartResponseTransfer::class)
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
    public function testClaimCartAction(): void
    {
        $this->collaborativeCartsRestApiFacadeMock->expects(self::atLeastOnce())
            ->method('claimCart')
            ->with($this->restCollaborativeCartRequestAttributesTransferMock)
            ->willReturn($this->claimCartResponseTransferMock);

        $claimCartResponseTransfer = $this->gatewayController
            ->claimCartAction($this->restCollaborativeCartRequestAttributesTransferMock);

        $this->assertInstanceOf(
            ClaimCartResponseTransfer::class,
            $this->claimCartResponseTransferMock
        );

        $this::assertEquals(
            $this->claimCartResponseTransferMock,
            $claimCartResponseTransfer
        );
    }
}
