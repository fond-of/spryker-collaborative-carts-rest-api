<?php

namespace FondOfSpryker\Zed\CollaborativeCartsRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCart\CollaborativeCartCreatorInterface;
use Generated\Shared\Transfer\ClaimCartResponseTransfer;
use Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer;

class CollaborativeCartsRestApiFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiBusinessFactory
     */
    protected $collaborativeCartsRestApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCart\CollaborativeCartCreatorInterface
     */
    protected $collaborativeCartCreatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestCollaborativeCartRequestAttributesTransfer
     */
    protected $restCollaborativeCartRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ClaimCartResponseTransfer
     */
    protected $claimCartResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CollaborativeCartsRestApi\Business\CollaborativeCartsRestApiFacade
     */
    protected $collaborativeCartsRestApiFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->collaborativeCartsRestApiBusinessFactoryMock = $this->getMockBuilder(CollaborativeCartsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartCreatorMock = $this->getMockBuilder(CollaborativeCartCreatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCollaborativeCartRequestAttributesTransferMock = $this->getMockBuilder(RestCollaborativeCartRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->claimCartResponseTransferMock = $this->getMockBuilder(ClaimCartResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collaborativeCartsRestApiFacade = new CollaborativeCartsRestApiFacade();
        $this->collaborativeCartsRestApiFacade->setFactory($this->collaborativeCartsRestApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testClaimCart(): void
    {
        $this->collaborativeCartsRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCollaborativeCartCreator')
            ->willReturn($this->collaborativeCartCreatorMock);

        $this->collaborativeCartCreatorMock->expects($this->atLeastOnce())
            ->method('claimCart')
            ->with($this->restCollaborativeCartRequestAttributesTransferMock)
            ->willReturn($this->claimCartResponseTransferMock);

        $claimCartResponseTransfer = $this->collaborativeCartsRestApiFacade
            ->claimCart($this->restCollaborativeCartRequestAttributesTransferMock);

        $this->assertInstanceOf(
            ClaimCartResponseTransfer::class,
            $claimCartResponseTransfer
        );

        $this->assertEquals(
            $this->claimCartResponseTransferMock,
            $claimCartResponseTransfer
        );
    }
}
