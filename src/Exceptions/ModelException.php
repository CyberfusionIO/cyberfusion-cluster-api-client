<?php

namespace Cyberfusion\ClusterApi\Exceptions;

use Throwable;

class ModelException extends ClusterApiException
{
    public static function propertyNotAvailable(string $property, ?Throwable $previous = null): self
    {
        return new self(
            sprintf('The property `%s` is not available for this model', $property),
            self::MODEL_PROPERTY_NOT_AVAILABLE,
            $previous
        );
    }
}
