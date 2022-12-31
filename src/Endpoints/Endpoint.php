<?php

namespace Cyberfusion\ClusterApi\Endpoints;

use Cyberfusion\ClusterApi\Contracts\Client as ClientContract;
use Cyberfusion\ClusterApi\Contracts\Model;
use Cyberfusion\ClusterApi\Exceptions\RequestException;
use Cyberfusion\ClusterApi\Support\Arr;

abstract class Endpoint
{
    protected ClientContract $client;

    /**
     * Endpoint constructor.
     * @param ClientContract $client
     */
    public function __construct(ClientContract $client)
    {
        $this->client = $client;
    }

    /**
     * @param Model $model
     * @param string $action
     * @param array $requiredAttributes
     * @throws RequestException
     */
    protected function validateRequired(Model $model, string $action, array $requiredAttributes = []): void
    {
        $modelFields = $model->toArray();

        $missing = [];
        foreach ($requiredAttributes as $requiredAttribute) {
            $value = $modelFields[$requiredAttribute] ?? null;
            if (is_null($value)) {
                $missing[] = $requiredAttribute;
                continue;
            }

            if (is_string($value) && trim($value) === '') {
                $missing[] = $requiredAttribute;
            }
        }

        if (count($missing) === 0) {
            return;
        }

        throw RequestException::invalidRequest(get_class($model), $action, $missing);
    }

    /**
     * @param array $array
     * @param array $fields
     * @return array
     */
    protected function filterFields(array $array, array $fields = []): array
    {
        if (count($fields) === 0) {
            return array_filter($array);
        }

        return Arr::only($array, $fields);
    }
}
