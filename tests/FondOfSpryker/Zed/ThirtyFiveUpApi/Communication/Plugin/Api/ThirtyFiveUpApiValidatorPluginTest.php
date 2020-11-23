<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacade;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class ThirtyFiveUpApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Communication\Plugin\Api\ThirtyFiveUpApiValidatorPlugin
     */
    protected $plugin;

    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(ThirtyFiveUpApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new class ($this->facadeMock) extends ThirtyFiveUpApiValidatorPlugin {
            /**
             * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface
             */
            public $facade;

            /**
             *  constructor.
             *
             * @param \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface $thirtyFiveUpFacade
             */
            public function __construct(ThirtyFiveUpApiFacadeInterface $thirtyFiveUpFacade)
            {
                $this->facade = $thirtyFiveUpFacade;
            }

            /**
             * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiFacadeInterface|\Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->facade;
            }
        };
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->facadeMock->expects($this->once())->method('validate')->willReturn([]);
        $this->plugin->validate($this->apiDataTransferMock);
    }
}
