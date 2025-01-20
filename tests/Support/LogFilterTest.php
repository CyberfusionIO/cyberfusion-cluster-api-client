<?php

namespace Cyberfusion\ClusterApi\Tests\Support;

use Cyberfusion\ClusterApi\Enums\Sort;
use Cyberfusion\ClusterApi\Support\LogFilter;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;

class LogFilterTest extends TestCase
{
    public function testLogFilterDefaults(): void
    {
        $logFilter = new LogFilter();

        $this->assertNull($logFilter->getTimestamp());
        $this->assertSame(100, $logFilter->getLimit());
        $this->assertSame(Sort::ASC, $logFilter->getSort());
    }

    public function testLogFilter(): void
    {
        $timestamp = Carbon::today()->subDay();
        $limit = 100;

        $logFilter = (new LogFilter())
            ->setTimestamp($timestamp)
            ->setLimit($limit)
            ->setSort(Sort::DESC);

        $this->assertSame($timestamp->format('c'), $logFilter->getTimestamp()->format('c'));
        $this->assertSame(100, $logFilter->getLimit());
        $this->assertSame(Sort::DESC, $logFilter->getSort());
    }

    public function testToQuery(): void
    {
        $timestamp = Carbon::today()->subDay();
        $limit = 100;

        $logFilter = (new LogFilter())
            ->setTimestamp($timestamp)
            ->setLimit($limit)
            ->setSort(Sort::DESC);

        $this->assertSame(
            'timestamp=' . $timestamp->format('Y-m-d') . 'T00%3A00%3A00%2B00%3A00&limit=100&sort=DESC',
            $logFilter->toQuery()
        );
    }
}
