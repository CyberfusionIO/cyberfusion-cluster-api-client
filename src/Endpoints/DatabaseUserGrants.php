<?php

namespace Cyberfusion\ClusterApi\Endpoints;

use Cyberfusion\ClusterApi\Exceptions\RequestException;
use Cyberfusion\ClusterApi\Models\DatabaseUserGrant;
use Cyberfusion\ClusterApi\Request;
use Cyberfusion\ClusterApi\Response;
use Cyberfusion\ClusterApi\Support\ListFilter;

class DatabaseUserGrants extends Endpoint
{
    /**
     * @param ListFilter|null $filter
     * @return Response
     * @throws RequestException
     */
    public function list(ListFilter $filter = null): Response
    {
        if (is_null($filter)) {
            $filter = new ListFilter();
        }

        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('database-user-grants?%s', $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'databaseUserGrants' => array_map(
                function (array $data) {
                    return (new DatabaseUserGrant())->fromArray($data);
                },
                $response->getData()
            ),
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws RequestException
     */
    public function get(int $id): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('database-user-grants/%d', $id));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'databaseUserGrant' => (new DatabaseUserGrant())->fromArray($response->getData()),
        ]);
    }

    /**
     * @param DatabaseUserGrant $databaseUserGrant
     * @return Response
     * @throws RequestException
     */
    public function create(DatabaseUserGrant $databaseUserGrant): Response
    {
        $this->validateRequired($databaseUserGrant, 'create', [
            'database_id',
            'database_user_id',
            'privilege_name',
        ]);

        $request = (new Request())
            ->setMethod(Request::METHOD_POST)
            ->setUrl('database-user-grants')
            ->setBody($this->filterFields($databaseUserGrant->toArray(), [
                'database_id',
                'database_user_id',
                'table_name',
                'privilege_name',
            ]));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        $databaseUserGrant = (new DatabaseUserGrant())->fromArray($response->getData());

        // Log which cluster is affected by this change
        $this
            ->client
            ->addAffectedCluster($databaseUserGrant->getClusterId());

        return $response->setData([
            'databaseUserGrant' => $databaseUserGrant,
        ]);
    }
}
