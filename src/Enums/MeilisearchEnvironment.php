<?php

namespace Cyberfusion\CoreApi\Enums;

class MeilisearchEnvironment
{
    public const PRODUCTION = 'production';
    public const DEVELOPMENT = 'development';

    public const AVAILABLE = [
        self::PRODUCTION,
        self::DEVELOPMENT,
    ];
}
