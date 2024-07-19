<?php

namespace Cyberfusion\CoreApi\Contracts;

use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;

interface Client
{
    /**
     * Performs the request.
     *
     * @throws RequestException
     */
    public function request(Request $request): Response;
}
