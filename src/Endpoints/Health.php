<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Models\Health as HealthModel;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;

class Health extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function get(): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl('health')
            ->setAuthenticationRequired(false);

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'health' => (new HealthModel())->fromArray($response->getData()),
        ]);
    }
}
