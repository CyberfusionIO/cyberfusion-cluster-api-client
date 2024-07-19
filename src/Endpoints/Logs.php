<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Models\AccessLog;
use Cyberfusion\CoreApi\Models\ErrorLog;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;
use Cyberfusion\CoreApi\Support\LogFilter;

class Logs extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function accessLogs(int $virtualHostId, ?LogFilter $filter = null): Response
    {
        if (!$filter instanceof LogFilter) {
            $filter = new LogFilter();
        }

        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('logs/access/%d?%s', $virtualHostId, $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'logs' => array_map(
                fn (array $data) => (new AccessLog())->fromArray($data),
                $response->getData()
            ),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function errorLogs(int $virtualHostId, ?LogFilter $filter = null): Response
    {
        if (!$filter instanceof LogFilter) {
            $filter = new LogFilter();
        }

        $request = (new Request())
            ->setMethod(Request::METHOD_GET)
            ->setUrl(sprintf('logs/error/%d?%s', $virtualHostId, $filter->toQuery()));

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'logs' => array_map(
                fn (array $data) => (new ErrorLog())->fromArray($data),
                $response->getData()
            ),
        ]);
    }
}
