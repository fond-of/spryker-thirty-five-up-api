<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model;

use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class ThirtyFiveUpApi implements ThirtyFiveUpApiInterface
{
    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
     */
    protected $thirtyFiveUpFacade;

    /**
     * @param \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface $thirtyFiveUpFacade
     */
    public function __construct(
        ThirtyFiveUpApiToApiQueryContainerInterface $apiQueryContainer,
        ThirtyFiveUpApiToThirtyFiveUpFacadeInterface $thirtyFiveUpFacade
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->thirtyFiveUpFacade = $thirtyFiveUpFacade;
    }

    /**
     * @param int $idThirtyFiveUpOrder
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idThirtyFiveUpOrder, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $thirtyFiveUpOrderTransfer = $this->createThirtyFiveUpOrderTransfer($apiDataTransfer->getData());

        $response = $this->thirtyFiveUpFacade->updateThirtyFiveUpOrder($thirtyFiveUpOrderTransfer);

        $orders = $response->getOrders();
        $thirtyFiveUpOrderTransfer = null;
        if ($orders->count() === 1) {
            $thirtyFiveUpOrderTransfer = $orders->getArrayCopy()[0];
        }

        if ($response->getCode() !== 200 || $thirtyFiveUpOrderTransfer === null) {
            throw new EntityNotSavedException(
                sprintf('Could not update thirty five up order with id %s', $idThirtyFiveUpOrder),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR
            );
        }

        return $this->apiQueryContainer->createApiItem(
            $thirtyFiveUpOrderTransfer,
            $thirtyFiveUpOrderTransfer->getId()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $thirtyFiveUpOrderTransfer = $this->createThirtyFiveUpOrderTransfer($apiRequestTransfer->getRequestData());

        $response = $this->thirtyFiveUpFacade->findThirtyFiveUpOrder($thirtyFiveUpOrderTransfer);

        if ($response->getCode() !== 200) {
            throw new EntityNotSavedException(
                sprintf('Could not update thirty five up order with id %s', $idThirtyFiveUpOrder),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR
            );
        }

        $data = [];
        $orders = $response->getOrders();
        if ($orders->count() > 0) {
            $data = $orders->getArrayCopy();
        }

        return $this->apiQueryContainer->createApiCollection($data);
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    protected function createThirtyFiveUpOrderTransfer(array $data): ThirtyFiveUpOrderTransfer
    {
        return (new ThirtyFiveUpOrderTransfer())->fromArray($data, true);
    }
}
