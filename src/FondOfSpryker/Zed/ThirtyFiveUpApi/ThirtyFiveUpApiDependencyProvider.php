<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi;

use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeBridge;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerBridge;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ThirtyFiveUpApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_CONTAINER_API = '35UP:QUERY_CONTAINER_API';
    public const FACADE_THIRTY_FIVE_UP = '35UP:FACADE_THIRTY_FIVE_UP';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addApiQueryContainer($container);
        $container = $this->addThirtyFiveUpFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addApiQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_API] = function (Container $container): ThirtyFiveUpApiToApiQueryContainerInterface {
            return new ThirtyFiveUpApiToApiQueryContainerBridge($container->getLocator()->api()->queryContainer());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addThirtyFiveUpFacade(Container $container): Container
    {
        $container[static::FACADE_THIRTY_FIVE_UP] = function (Container $container): ThirtyFiveUpApiToThirtyFiveUpFacadeInterface {
            return new ThirtyFiveUpApiToThirtyFiveUpFacadeBridge($container->getLocator()->thirtyFiveUp()->facade());
        };

        return $container;
    }
}
