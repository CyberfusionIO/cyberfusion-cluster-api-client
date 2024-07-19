<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Exceptions\ListFilterException;
use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Models\HAProxyListenToNode;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;
use Cyberfusion\CoreApi\Support\ListFilter;

class HAProxyListensToNodes extends Endpoint
{
    /**
     * @throws RequestException
     * @throws ListFilterException
     */
    public function list(?ListFilter $filter = null): Response
    {
        if (!$filter instanceof ListFilter) {
            $filter = HAProxyListenToNode::listFilter();
        }

        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('haproxy-listens-to-nodes?%s', $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'HAProxyListensToNodes' => array_map(
                fn (array $data) => (new HAProxyListenToNode())->fromArray($data),
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
            ->setUrl(sprintf('haproxy-listens-to-nodes/%d', $id));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'haProxyListenToNode' => (new HAProxyListenToNode())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function create(HAProxyListenToNode $haProxyListenToNode): Response
    {
        $this->validateRequired($haProxyListenToNode, 'create', [
            'haproxy_listen_id',
            'node_id',
        ]);

        $request = (new Request())
            ->setMethod(Request::METHOD_POST)
            ->setUrl('haproxy-listens-to-nodes')
            ->setBody(
                $this->filterFields($haProxyListenToNode->toArray(), [
                    'haproxy_listen_id',
                    'node_id',
                ])
            );

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'haProxyListenToNode' => (new HAProxyListenToNode())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function delete(int $id): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_DELETE)
            ->setUrl(sprintf('haproxy-listens-to-nodes/%d', $id));

        return $this
            ->client
            ->request($request);
    }
}
