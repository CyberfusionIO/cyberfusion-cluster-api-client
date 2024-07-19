<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Enums\TimeUnit;
use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Models\Database;
use Cyberfusion\CoreApi\Models\DatabaseComparison;
use Cyberfusion\CoreApi\Models\DatabaseUsage;
use Cyberfusion\CoreApi\Models\TaskCollection;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;
use Cyberfusion\CoreApi\Support\ListFilter;
use Cyberfusion\CoreApi\Support\Str;
use DateTimeInterface;

class Databases extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function list(?ListFilter $filter = null): Response
    {
        if (!$filter instanceof ListFilter) {
            $filter = new ListFilter();
        }

        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('databases?%s', $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'databases' => array_map(
                fn (array $data) => (new Database())->fromArray($data),
                $response->getData()
            ),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function get(int $id): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('databases/%d', $id));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'database' => (new Database())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function create(Database $database): Response
    {
        $this->validateRequired($database, 'create', [
            'name',
            'server_software_name',
            'cluster_id',
        ]);

        $request = (new Request())
            ->setMethod(Request::METHOD_POST)
            ->setUrl('databases')
            ->setBody(
                $this->filterFields($database->toArray(), [
                    'name',
                    'server_software_name',
                    'cluster_id',
                    'backups_enabled',
                    'optimizing_enabled',
                ])
            );

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        $database = (new Database())->fromArray($response->getData());

        return $response->setData([
            'database' => $database,
        ]);
    }

    /**
     * @throws RequestException
     */
    public function update(Database $database): Response
    {
        $this->validateRequired($database, 'update', [
            'name',
            'server_software_name',
            'optimizing_enabled',
            'backups_enabled',
            'id',
            'cluster_id',
        ]);

        $request = (new Request())
            ->setMethod(Request::METHOD_PUT)
            ->setUrl(sprintf('databases/%d', $database->getId()))
            ->setBody(
                $this->filterFields($database->toArray(), [
                    'name',
                    'server_software_name',
                    'optimizing_enabled',
                    'backups_enabled',
                    'id',
                    'cluster_id',
                ])
            );

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'database' => (new Database())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function delete(int $id): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_DELETE)
            ->setUrl(sprintf('databases/%d', $id));

        return $this
            ->client
            ->request($request);
    }

    /**
     * @throws RequestException
     */
    public function usages(int $id, DateTimeInterface $from, string $timeUnit = TimeUnit::HOURLY): Response
    {
        $url = sprintf(
            'databases/usages/%d?%s',
            $id,
            http_build_query([
                'timestamp' => $from->format('c'),
                'time_unit' => $timeUnit,
            ])
        );

        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl($url);

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'databaseUsage' => count($response->getData()) !== 0
                ? array_map(
                    fn (array $data) => (new DatabaseUsage())->fromArray($data),
                    $response->getData()
                )
                : null,
        ]);
    }

    /**
     * @throws RequestException
     */
    public function compareTo(int $leftDatabaseId, int $rightDatabaseId): Response
    {
        $url = sprintf(
            'databases/%d/comparison?right_database_id=%d',
            $leftDatabaseId,
            $rightDatabaseId
        );

        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl($url);

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'databaseComparison' => (new DatabaseComparison())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function syncTo(int $leftDatabaseId, int $rightDatabaseId, ?string $callbackUrl = null): Response
    {
        $url = Str::optionalQueryParameters(
            sprintf(
                'databases/%d/sync?right_database_id=%d',
                $leftDatabaseId,
                $rightDatabaseId
            ),
            ['callback_url' => $callbackUrl]
        );

        $request = (new Request())
            ->setMethod(Request::METHOD_POST)
            ->setUrl($url);

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        $taskCollection = (new TaskCollection())->fromArray($response->getData());

        return $response->setData([
            'taskCollection' => $taskCollection,
        ]);
    }
}
