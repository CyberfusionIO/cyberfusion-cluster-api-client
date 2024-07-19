<?php

namespace Cyberfusion\CoreApi\Enums;

class PassengerEnvironment
{
    public const PRODUCTION = 'Production';
    public const DEVELOPMENT = 'Development';

    public const AVAILABLE = [
        self::PRODUCTION,
        self::DEVELOPMENT,
    ];
}
