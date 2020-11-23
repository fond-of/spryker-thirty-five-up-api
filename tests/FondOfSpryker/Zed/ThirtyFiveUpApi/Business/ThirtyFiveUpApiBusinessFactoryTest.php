<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpOrderApiInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model\Validator\ThirtyFiveUpApiValidatorInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeBridge;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerBridge;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepository;
use FondOfSpryker\Zed\ThirtyFiveUpApi\ThirtyFiveUpApiDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ThirtyFiveUpApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory
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
     * @var \FondOfSpryker\Zed\ThirtyFiveUp\Business\ThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\AbstractRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpFacadeMock = $this->getMockBuilder(ThirtyFiveUpApiToThirtyFiveUpFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpQueryContainerMock = $this->getMockBuilder(ThirtyFiveUpApiToApiQueryContainerBridge::class)->disableOriginalConstructor()->getMock();
        $this->repositoryMock = $this->getMockBuilder(ThirtyFiveUpApiRepository::class)->disableOriginalConstructor()->getMock();

        $this->factory = new ThirtyFiveUpApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @throws \Exception
     *
     * @return void
     */
    public function testCreateThirtyFiveUpApi(): void
    {
        $self = $this;
        $this->containerMock->method('has')->willReturn(true);
        $this->containerMock->method('get')->willReturnCallback(static function ($key) use ($self) {
            if ($key === ThirtyFiveUpApiDependencyProvider::QUERY_CONTAINER_API) {
                return $self->thirtyFiveUpQueryContainerMock;
            }
            if ($key === ThirtyFiveUpApiDependencyProvider::FACADE_THIRTY_FIVE_UP) {
                return $self->thirtyFiveUpFacadeMock;
            }

            throw new Exception('error');
        });

        $this->assertInstanceOf(ThirtyFiveUpOrderApiInterface::class, $this->factory->createThirtyFiveUpApi());
    }

    /**
     * @return void
     */
    public function testCreateThirtyFiveUpApiValidator(): void
    {
        $this->assertInstanceOf(
            ThirtyFiveUpApiValidatorInterface::class,
            $this->factory->createThirtyFiveUpApiValidator()
        );
    }
}
