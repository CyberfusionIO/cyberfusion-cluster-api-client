<?php

namespace Cyberfusion\CoreApi\Exceptions;

use Throwable;

class ValidationException extends CoreApiException
{
    public static function validationFailed(array $failedValidations = [], Throwable $previous = null): self
    {
        return new self(
            sprintf('The validation failed: `%s`', implode(', ', $failedValidations)),
            self::VALIDATION_FAILED,
            $previous
        );
    }
}
