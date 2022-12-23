<?php

declare(strict_types=1);

namespace App\Service\RickAndMortyApi\ApiClient;

use App\Infrastructure\ApiClient\AdapterInterface;
use App\Infrastructure\ApiClient\Enum\HttpCode;
use App\Infrastructure\ApiClient\Exception\ApiClientException;
use App\Infrastructure\ApiClient\Exception\MappingException;
use App\Infrastructure\ApiClient\Exception\TransformationException;
use App\Infrastructure\ApiClient\Request\IRequestFactory;
use App\Infrastructure\ApiClient\Response\DataResponse;
use App\Infrastructure\ApiClient\Response\IDataResponse;
use App\Infrastructure\ApiClient\Response\IResponse;
use App\Infrastructure\ApiClient\Util\ResponseUtil;
use App\Service\RickAndMortyApi\ApiClient\Contract\CharacterContract;
use App\Service\RickAndMortyApi\ApiClient\Exception\CharacterNotFoundException;
use App\Service\RickAndMortyApi\ApiClient\Mapper\CharacterMapper;

class Character extends AbstractContractImplementor implements CharacterContract
{
    public function __construct(
        AdapterInterface $adapter,
        IRequestFactory $requestFactory,
        protected CharacterMapper $characterMapper
    ) {
        parent::__construct($adapter, $requestFactory);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): IResponse|IDataResponse
    {
        $request = $this->requestFactory->createGetRequest(
            $this->joinPaths(self::BASE_PATH, (string) $id)
        );
        $response = $this->adapter->call($request);

        if ($response->getStatusCode() === HttpCode::NOT_FOUND) {
            throw new CharacterNotFoundException(
                sprintf("Character with id '%d' was not found", $id)
            );
        }

        $result = $this->deserializeResponse($response->getBody());
        try {
            return new DataResponse(
                ResponseUtil::isErrorStatus($response),
                $response->getStatusCode(),
                $this->characterMapper->mapOne($result)
            );
        } catch (MappingException | TransformationException $e) {
            throw new ApiClientException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function getByMultipleIds(int ...$id): IResponse|IDataResponse
    {
        $request = $this->requestFactory->createGetRequest(
            $this->joinPaths(self::BASE_PATH, implode(',', $id))
        );
        $response = $this->adapter->call($request);

        $result = $this->deserializeResponse($response->getBody());
        try {
            return new DataResponse(
                ResponseUtil::isErrorStatus($response),
                $response->getStatusCode(),
                $this->characterMapper->mapMany($result)
            );
        } catch (MappingException | TransformationException $e) {
            throw new ApiClientException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
