<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\FuncCall\CountArrayToEmptyArrayComparisonRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\Strict\Rector\Empty_\DisallowedEmptyRuleFixerRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([
        SetList::PHP_81,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
    ]);

    $rectorConfig->paths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ]);

    $rectorConfig->skip([
        CountArrayToEmptyArrayComparisonRector::class,
        DisallowedEmptyRuleFixerRector::class,
    ]);

    $rectorConfig->importNames();
    $rectorConfig->importShortClasses();
};
