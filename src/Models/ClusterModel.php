<?php

namespace Cyberfusion\CoreApi\Models;

use Cyberfusion\CoreApi\Contracts\Model;
use Cyberfusion\CoreApi\Exceptions\ListFilterException;
use Cyberfusion\CoreApi\Exceptions\ModelException;
use Cyberfusion\CoreApi\Support\ListFilter;
use Cyberfusion\CoreApi\Support\Str;
use JsonSerializable;

abstract class ClusterModel implements JsonSerializable, Model
{
    /**
     * @throws ListFilterException
     */
    public static function listFilter(): ListFilter
    {
        return ListFilter::forModel(static::class);
    }

    /**
     * Provide fallback to allow the user of properties but still using the getters and setters.
     *
     * @return mixed
     * @throws ModelException
     */
    public function __get(string $name)
    {
        $method = sprintf('get%s', Str::studly($name));
        if (!method_exists($this, $method)) {
            throw ModelException::propertyNotAvailable($name);
        }

        return $this->{$method}();
    }

    /**
     * Provide fallback to allow the user of properties but still using the getters and setters.
     *
     * @throws ModelException
     */
    public function __set(string $name, mixed $value): void
    {
        $method = sprintf('set%s', Str::studly($name));
        if (!method_exists($this, $method)) {
            throw ModelException::propertyNotAvailable($name);
        }

        $this->{$method}($value);
    }

    /**
     * Serializes the model to a value that can be serialized with json_encode.
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
