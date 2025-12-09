<?php

namespace Cyberfusion\ClusterApi\Enums;

class ShellName
{
    public const BASH = 'Bash';
    public const NOLOGIN = 'nologin';

    public const AVAILABLE = [
        self::BASH,
        self::NOLOGIN,
    ];
}
