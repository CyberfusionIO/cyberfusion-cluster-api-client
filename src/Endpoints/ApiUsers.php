<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;

class ApiUsers extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function clustersChildren(): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl('api-users/clusters-children');

        return $this
            ->client
            ->request($request);
    }
}
