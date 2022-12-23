<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\DataTransformer;

use App\Infrastructure\ApiClient\Exception\TransformationException;
use DateTimeInterface;
use DateTime;

/**
 * @extends AbstractTransformer<string, DateTimeInterface, DateTimeInterface>
 */
class StringDateTimeTransformer extends AbstractTransformer
{
    /**
     * @inheritDoc
     */
    public function transform(mixed $val): DateTimeInterface
    {
        try {
            return new DateTime($val);
        } catch (\Exception $e) {
            throw new TransformationException(
                sprintf("Could not transform string to DateTime due to %s", $e->getMessage()),
                $e->getCode(),
                $e->getPrevious()
            );
        }
    }
}
