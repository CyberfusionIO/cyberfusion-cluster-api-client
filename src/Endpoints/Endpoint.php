<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Contracts\Client as ClientContract;
use Cyberfusion\CoreApi\Contracts\Model;
use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Support\Arr;

abstract class Endpoint
{
    public function __construct(protected ClientContract $client)
    {
    }

    /**
     * @throws RequestException
     */
    protected function validateRequired(Model $model, string $action, array $requiredAttributes = []): void
    {
        $modelFields = $model->toArray();

        $missing = [];
        foreach ($requiredAttributes as $requiredAttribute) {
            if (!array_key_exists($requiredAttribute, $modelFields)) {
                $missing[] = $requiredAttribute;
                continue;
            }

            $value = $modelFields[$requiredAttribute] ?? null;
            if (is_string($value) && trim($value) === '') {
                $missing[] = $requiredAttribute;
            }
        }

        if (count($missing) === 0) {
            return;
        }

        throw RequestException::invalidRequest($model::class, $action, $missing);
    }

    protected function filterFields(array $array, array $fields = []): array
    {
        return Arr::only($array, $fields);
    }
}
