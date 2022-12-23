<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient;

use App\Infrastructure\ApiClient\AdapterInterface;
use App\Infrastructure\ApiClient\Exception\ApiClientException;
use App\Infrastructure\ApiClient\Exception\MappingException;
use App\Infrastructure\ApiClient\Exception\TransformationException;
use App\Infrastructure\ApiClient\Filter\IFilterCollection;
use App\Infrastructure\ApiClient\Request\IRequestFactory;
use App\Infrastructure\ApiClient\Response\IPaginatedResponse;
use App\Infrastructure\ApiClient\Response\PaginatedResponse;
use App\Infrastructure\ApiClient\Util\ResponseUtil;
use App\Infrastructure\ApiClient\Util\UriUtil;
use App\Service\RickAndMortyApi\ApiClient\Contract\LocationContract;
use App\Service\RickAndMortyApi\ApiClient\Mapper\LocationMapper;
use App\Service\RickAndMortyApi\ApiClient\Mapper\PaginationMapper;

class Location extends AbstractContractImplementor implements LocationContract
{
    public function __construct(
        AdapterInterface $adapter,
        IRequestFactory $requestFactory,
        protected LocationMapper $locationMapper,
        protected PaginationMapper $paginationMapper
    ) {
        parent::__construct($adapter, $requestFactory);
    }

    /**
     * @inheritDoc
     */
    public function getList(?IFilterCollection $filters): IPaginatedResponse
    {
        $request = $this->requestFactory->createGetRequest(self::BASE_PATH);

        if ($filters) {
            $request = UriUtil::appendQuery(
                $request,
                $filters->toArray()
            );
        }

        $response = $this->adapter->call($request);

        $result = $this->deserializeResponse($response->getBody());
        try {
            return new PaginatedResponse(
                ResponseUtil::isErrorStatus($response),
                $response->getStatusCode(),
                $this->locationMapper->mapMany($result['results'] ?? []),
                $this->paginationMapper->mapOne($result['info'])
            );
        } catch (MappingException | TransformationException $e) {
            throw new ApiClientException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
