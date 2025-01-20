<?php

namespace Cyberfusion\ClusterApi\Enums;

class FirewallRuleExternalProviderName
{
    public const ATLASSIAN = 'Atlassian';
    public const AWS = 'AWS';
    public const BUDDY = 'Buddy';
    public const GOOGLE_CLOUD = 'Google Cloud';

    public const AVAILABLE = [
        self::ATLASSIAN,
        self::AWS,
        self::BUDDY,
        self::GOOGLE_CLOUD,
    ];
}
