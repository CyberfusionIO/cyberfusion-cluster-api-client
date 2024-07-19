<?php

namespace Cyberfusion\CoreApi\Contracts;

interface Filter
{
    public function toQuery(): string;
}
