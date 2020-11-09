<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence;

use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapper;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\ThirtyFiveUpApiDependencyProvider;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\ThirtyFiveUpApi\ThirtyFiveUpApiConfig getConfig()
 * @method \FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface getRepository()
 */
class ThirtyFiveUpApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery
     */
    public function createThirtyFiveUpOrderQuery(): ThirtyFiveUpOrderQuery
    {
        return ThirtyFiveUpOrderQuery::create();
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapperInterface]
     */
    public function createTransferMapper(): TransferMapperInterface
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface
     */
    public function getQueryBuilderContainer(): ThirtyFiveUpApiToApiQueryBuilderContainerInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::QUERY_BUILDER_CONTAINER_API);
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface
     */
    public function getQueryContainer(): ThirtyFiveUpApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
     */
    public function getThirtyFiveUpFacade(): ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::FACADE_THIRTY_FIVE_UP);
    }
}
