<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Models\Node;
use Cyberfusion\CoreApi\Models\NodeProduct;
use Cyberfusion\CoreApi\Models\TaskCollection;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;
use Cyberfusion\CoreApi\Support\ListFilter;
use Cyberfusion\CoreApi\Support\Str;

class Nodes extends Endpoint
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
            ->setUrl(sprintf('nodes?%s', $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'nodes' => array_map(
                fn (array $data) => (new Node())->fromArray($data),
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
            ->setUrl(sprintf('nodes/%d', $id));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'node' => (new Node())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function create(Node $node, ?string $callbackUrl = null): Response
    {
        $this->validateRequired($node, 'create', [
            'groups',
            'comment',
            'product',
            'load_balancer_health_checks_groups_pairs',
            'groups_properties',
            'cluster_id',
        ]);

        $url = Str::optionalQueryParameters('nodes', ['callback_url' => $callbackUrl]);

        $request = (new Request())
            ->setMethod(Request::METHOD_POST)
            ->setUrl($url)
            ->setBody(
                $this->filterFields($node->toArray(), [
                    'groups',
                    'comment',
                    'product',
                    'load_balancer_health_checks_groups_pairs',
                    'groups_properties',
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
            'taskCollection' => (new TaskCollection())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function update(Node $node): Response
    {
        $this->validateRequired($node, 'update', [
            'groups',
            'comment',
            'product',
            'load_balancer_health_checks_groups_pairs',
            'groups_properties',
            'cluster_id',
            'id',
            'hostname',
            'is_ready',
        ]);

        $request = (new Request())
            ->setMethod(Request::METHOD_PUT)
            ->setUrl(sprintf('nodes/%d', $node->getId()))
            ->setBody(
                $this->filterFields($node->toArray(), [
                    'groups',
                    'comment',
                    'product',
                    'load_balancer_health_checks_groups_pairs',
                    'groups_properties',
                    'cluster_id',
                    'id',
                    'hostname',
                    'is_ready',
                ])
            );

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'node' => (new Node())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function delete(int $id): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_DELETE)
            ->setUrl(sprintf('nodes/%d', $id));

        return $this
            ->client
            ->request($request);
    }

    /**
     * @throws RequestException
     */
    public function products(): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl('nodes/products');

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'nodeProducts' => array_map(
                fn (array $data) => (new NodeProduct())->fromArray($data),
                $response->getData()
            ),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function xgrade(int $id, string $product, ?string $callbackUrl = null): Response
    {
        $url = Str::optionalQueryParameters(
            sprintf('nodes/%d/xgrade?product=%s', $id, $product),
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

        return $response->setData([
            'taskCollection' => (new TaskCollection())->fromArray($response->getData()),
        ]);
    }
}
