<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Models\Tombstone;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;
use Cyberfusion\CoreApi\Support\ListFilter;

class Tombstones extends Endpoint
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
            ->setUrl(sprintf('tombstones?%s', $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'tombstones' => array_map(
                fn (array $data) => (new Tombstone())->fromArray($data),
                $response->getData()
            ),
        ]);
    }
}
