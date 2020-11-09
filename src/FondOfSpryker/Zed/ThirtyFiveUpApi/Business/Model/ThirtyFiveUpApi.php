<?php

namespace FondOfSpryker\Zed\ThirtyFiveUpApi\Business\Model;

use Exception;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface;
use FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface;
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
     * @var \FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfSpryker\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface $thirtyFiveUpFacade
     * @param \FondOfSpryker\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface $repository
     */
    public function __construct(
        ThirtyFiveUpApiToApiQueryContainerInterface $apiQueryContainer,
        ThirtyFiveUpApiToThirtyFiveUpFacadeInterface $thirtyFiveUpFacade,
        ThirtyFiveUpApiRepositoryInterface $repository
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->thirtyFiveUpFacade = $thirtyFiveUpFacade;
        $this->repository = $repository;
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

        try {
            $thirtyFiveUpOrderTransfer = $this->thirtyFiveUpFacade->updateThirtyFiveUpOrder($thirtyFiveUpOrderTransfer);
        } catch (Exception $exception) {
            throw new EntityNotSavedException(
                sprintf('Could not update thirty five up order with id %s', $idThirtyFiveUpOrder),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
                $exception
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
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->repository->find($apiRequestTransfer);
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
