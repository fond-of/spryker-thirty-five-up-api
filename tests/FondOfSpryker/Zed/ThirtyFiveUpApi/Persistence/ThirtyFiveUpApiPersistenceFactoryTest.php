<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeBridge;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerBridge;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerBridge;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\ThirtyFiveUpApiDependencyProvider;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery;
use Spryker\Zed\Kernel\Container;

class ThirtyFiveUpApiPersistenceFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiPersistenceFactory
     */
    protected $factory;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpQueryContainerMock;

    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpQueryBuilderContainerMock;

    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpFacadeMock;

    /**
     * @var \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderQueryMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpFacadeMock = $this->getMockBuilder(ThirtyFiveUpApiToThirtyFiveUpFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpQueryContainerMock = $this->getMockBuilder(ThirtyFiveUpApiToApiQueryContainerBridge::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpQueryBuilderContainerMock = $this->getMockBuilder(ThirtyFiveUpApiToApiQueryBuilderContainerBridge::class)->disableOriginalConstructor()->getMock();
        $this->orderQueryMock = $this->getMockBuilder(ThirtyFiveUpOrderQuery::class)->disableOriginalConstructor()->getMock();

        $this->factory = new ThirtyFiveUpApiPersistenceFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateTransferMapper(): void
    {
        $this->assertInstanceOf(
            TransferMapperInterface::class,
            $this->factory->createTransferMapper()
        );
    }

    /**
     * @return void
     */
    public function testGetThirtyFiveUpOrderQuery(): void
    {
        $this->containerMock->method('has')->willReturn(true);
        $this->containerMock->method('get')->with(ThirtyFiveUpApiDependencyProvider::QUERY_THIRTY_FIVE_UP_ORDER)->willReturn($this->orderQueryMock);

        $this->assertInstanceOf(ThirtyFiveUpOrderQuery::class, $this->factory->getThirtyFiveUpOrderQuery());
    }

    /**
     * @return void
     */
    public function testGetQueryBuilderContainer(): void
    {
        $this->containerMock->method('has')->willReturn(true);
        $this->containerMock->method('get')->with(ThirtyFiveUpApiDependencyProvider::QUERY_BUILDER_CONTAINER_API)->willReturn($this->thirtyFiveUpQueryBuilderContainerMock);

        $this->assertInstanceOf(ThirtyFiveUpApiToApiQueryBuilderContainerInterface::class, $this->factory->getQueryBuilderContainer());
    }

    /**
     * @return void
     */
    public function testGetQueryContainer(): void
    {
        $this->containerMock->method('has')->willReturn(true);
        $this->containerMock->method('get')->with(ThirtyFiveUpApiDependencyProvider::QUERY_CONTAINER_API)->willReturn($this->thirtyFiveUpQueryContainerMock);

        $this->assertInstanceOf(ThirtyFiveUpApiToApiQueryContainerInterface::class, $this->factory->getQueryContainer());
    }

    /**
     * @return void
     */
    public function testGetThirtyFiveUpFacade(): void
    {
        $this->containerMock->method('has')->willReturn(true);
        $this->containerMock->method('get')->with(ThirtyFiveUpApiDependencyProvider::FACADE_THIRTY_FIVE_UP)->willReturn($this->thirtyFiveUpFacadeMock);

        $this->assertInstanceOf(ThirtyFiveUpApiToThirtyFiveUpFacadeInterface::class, $this->factory->getThirtyFiveUpFacade());
    }
}
