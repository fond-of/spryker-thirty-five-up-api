<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence;

use FondOfSpryker\Zed\ThirtyFiveUp\Exception\ThirtyFiveUpOrderNotFoundException;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiPaginationTransfer;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\Map\ThirtyFiveUpOrderTableMap;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiPersistenceFactory getFactory()
 */
class ThirtyFiveUpApiRepository extends AbstractRepository implements ThirtyFiveUpApiRepositoryInterface
{
    /**
     * @var \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery
     */
    protected $orderQuery;

    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface
     */
    protected $queryBuilderContainer;

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $query = $this->buildQuery($apiRequestTransfer);

        $collection = $this->getFactory()->createTransferMapper()->toTransferCollection(
            $query->find()->getData()
        );

        foreach ($collection as $id => $orderTransfer) {
            $collection[$id] = $this->convert($orderTransfer)->getData();
        }
        $apiCollectionTransfer = $this->getFactory()->getQueryContainer()->createApiCollection($collection);
        $apiCollectionTransfer = $this->addPagination($query, $apiCollectionTransfer, $apiRequestTransfer);

        return $apiCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\FosThirtyFiveUpOrderEntityTransfer $orderEntityTransfer
     *
     * @throws \FondOfSpryker\Zed\ThirtyFiveUp\Exception\ThirtyFiveUpOrderNotFoundException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function convert(FosThirtyFiveUpOrderEntityTransfer $orderEntityTransfer): ApiItemTransfer
    {
        $orderTransfer = $this->getFactory()->getThirtyFiveUpFacade()->findThirtyFiveUpOrderById($orderEntityTransfer->getIdThirtyFiveUpOrder());

        if ($orderTransfer === null) {
            throw new ThirtyFiveUpOrderNotFoundException(sprintf('Order with ID %s not found!', $orderEntityTransfer->getIdThirtyFiveUpOrder()));
        }

        return $this->getFactory()->getQueryContainer()->createApiItem($orderTransfer, $orderTransfer->getId());
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param \Generated\Shared\Transfer\ApiCollectionTransfer $apiCollectionTransfer
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return array|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected function addPagination(ModelCriteria $query, ApiCollectionTransfer $apiCollectionTransfer, ApiRequestTransfer $apiRequestTransfer)
    {
        $query->setOffset(0);
        $query->setLimit(-1);
        $total = $query->count();
        $page = $apiRequestTransfer->getFilter()->getLimit() ? ($apiRequestTransfer->getFilter()->getOffset() / $apiRequestTransfer->getFilter()->getLimit() + 1) : 1;
        $pageTotal = ($total && $apiRequestTransfer->getFilter()->getLimit()) ? (int)ceil($total / $apiRequestTransfer->getFilter()->getLimit()) : 1;
        if ($page > $pageTotal) {
            throw new NotFoundHttpException('Out of bounds.', null, ApiConfig::HTTP_CODE_NOT_FOUND);
        }

        $apiPaginationTransfer = new ApiPaginationTransfer();
        $apiPaginationTransfer->setItemsPerPage($apiRequestTransfer->getFilter()->getLimit());
        $apiPaginationTransfer->setPage($page);
        $apiPaginationTransfer->setTotal($total);
        $apiPaginationTransfer->setPageTotal($pageTotal);

        $apiCollectionTransfer->setPagination($apiPaginationTransfer);

        return $apiCollectionTransfer;
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderQuery
     */
    protected function getOrderQuery(): ThirtyFiveUpOrderQuery
    {
        if ($this->orderQuery === null) {
            $this->orderQuery = $this->getFactory()->getThirtyFiveUpOrderQuery();
        }

        return $this->orderQuery;
    }

    /**
     * @return \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface
     */
    protected function getQueryBuilderContainer(): ThirtyFiveUpApiToApiQueryBuilderContainerInterface
    {
        if ($this->queryBuilderContainer === null) {
            $this->queryBuilderContainer = $this->getFactory()->getQueryBuilderContainer();
        }

        return $this->queryBuilderContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function buildQuery(ApiRequestTransfer $apiRequestTransfer)
    {
        $apiQueryBuilderQueryTransfer = $this->buildApiQueryBuilderQuery($apiRequestTransfer);

        $query = $this->getOrderQuery();
        $query = $this->getQueryBuilderContainer()->buildQueryFromRequest($query, $apiQueryBuilderQueryTransfer);

        return $query;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer
     */
    protected function buildApiQueryBuilderQuery(ApiRequestTransfer $apiRequestTransfer)
    {
        $columnSelectionTransfer = $this->buildColumnSelection();

        $apiQueryBuilderQueryTransfer = new ApiQueryBuilderQueryTransfer();
        $apiQueryBuilderQueryTransfer->setApiRequest($apiRequestTransfer);
        $apiQueryBuilderQueryTransfer->setColumnSelection($columnSelectionTransfer);

        return $apiQueryBuilderQueryTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer
     */
    protected function buildColumnSelection(): PropelQueryBuilderColumnSelectionTransfer
    {
        $columnSelectionTransfer = new PropelQueryBuilderColumnSelectionTransfer();
        $tableColumns = ThirtyFiveUpOrderTableMap::getFieldNames(TableMap::TYPE_FIELDNAME);

        foreach ($tableColumns as $columnAlias) {
            $columnTransfer = new PropelQueryBuilderColumnTransfer();
            $columnTransfer->setName(ThirtyFiveUpOrderTableMap::TABLE_NAME . '.' . $columnAlias);
            $columnTransfer->setAlias($columnAlias);

            $columnSelectionTransfer->addTableColumn($columnTransfer);
        }

        return $columnSelectionTransfer;
    }
}
