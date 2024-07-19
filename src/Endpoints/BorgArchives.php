<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Models\BorgArchive;
use Cyberfusion\CoreApi\Models\BorgArchiveContent;
use Cyberfusion\CoreApi\Models\BorgArchiveDatabaseCreation;
use Cyberfusion\CoreApi\Models\BorgArchiveMetadata;
use Cyberfusion\CoreApi\Models\BorgArchiveUnixUserCreation;
use Cyberfusion\CoreApi\Models\TaskCollection;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;
use Cyberfusion\CoreApi\Support\ListFilter;
use Cyberfusion\CoreApi\Support\Str;

class BorgArchives extends Endpoint
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
            ->setUrl(sprintf('borg-archives?%s', $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'borgArchives' => array_map(
                fn (array $data) => (new BorgArchive())->fromArray($data),
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
            ->setUrl(sprintf('borg-archives/%d', $id));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'borgArchive' => (new BorgArchive())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function createDatabase(
        BorgArchiveDatabaseCreation $borgArchiveDatabaseCreation,
        ?string $callbackUrl = null
    ): Response {
        $this->validateRequired($borgArchiveDatabaseCreation, 'create', [
            'name',
            'borg_repository_id',
            'database_id',
        ]);

        $url = Str::optionalQueryParameters(
            'borg-archives/database',
            ['callback_url' => $callbackUrl]
        );

        $request = (new Request())
            ->setMethod(Request::METHOD_POST)
            ->setUrl($url)
            ->setBody(
                $this->filterFields($borgArchiveDatabaseCreation->toArray(), [
                    'name',
                    'borg_repository_id',
                    'database_id',
                ])
            );

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

    /**
     * @throws RequestException
     */
    public function createUnixUser(
        BorgArchiveUnixUserCreation $borgArchiveUnixUserCreation,
        ?string $callbackUrl = null
    ): Response {
        $this->validateRequired($borgArchiveUnixUserCreation, 'create', [
            'name',
            'borg_repository_id',
            'unix_user_id',
        ]);

        $url = Str::optionalQueryParameters(
            'borg-archives/unix-user',
            ['callback_url' => $callbackUrl]
        );

        $request = (new Request())
            ->setMethod(Request::METHOD_POST)
            ->setUrl($url)
            ->setBody(
                $this->filterFields($borgArchiveUnixUserCreation->toArray(), [
                    'name',
                    'borg_repository_id',
                    'unix_user_id',
                ])
            );

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

    /**
     * @throws RequestException
     */
    public function metadata(int $id): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('borg-archives/%d/metadata', $id));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'borgArchiveMetadata' => (new BorgArchiveMetadata())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function restore(int $id, ?string $path = null, ?string $callbackUrl = null): Response
    {
        $url = Str::optionalQueryParameters(
            sprintf('borg-archives/%d/restore', $id),
            ['path' => $path, 'callback_url' => $callbackUrl]
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

    /**
     * @throws RequestException
     */
    public function download(int $id, ?string $path = null, ?string $callbackUrl = null): Response
    {
        $url = Str::optionalQueryParameters(
            sprintf('borg-archives/%d/download', $id),
            ['path' => $path, 'callback_url' => $callbackUrl]
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

    /**
     * @throws RequestException
     */
    public function contents(int $id, ?string $path = null): Response
    {
        $url = Str::optionalQueryParameters(
            sprintf('borg-archives/%d/contents', $id),
            ['path' => $path]
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
            'contents' => array_map(
                fn (array $data) => (new BorgArchiveContent())->fromArray($data),
                $response->getData()
            ),
        ]);
    }
}
