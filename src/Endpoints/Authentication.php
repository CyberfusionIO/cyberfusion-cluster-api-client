<?php

namespace Cyberfusion\CoreApi\Endpoints;

use Cyberfusion\CoreApi\Exceptions\RequestException;
use Cyberfusion\CoreApi\Models\Login;
use Cyberfusion\CoreApi\Models\Token;
use Cyberfusion\CoreApi\Models\UserInfo;
use Cyberfusion\CoreApi\Request;
use Cyberfusion\CoreApi\Response;

class Authentication extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function login(Login $login): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_POST)
            ->setUrl('login/access-token')
            ->setBody($login->toArray())
            ->setAuthenticationRequired(false)
            ->setBodySchema(Request::BODY_SCHEMA_FORM);

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'token' => (new Token())->fromArray($response->getData()),
        ]);
    }

    /**
     * @throws RequestException
     */
    public function verify(): Response
    {
        $request = (new Request())
            ->setMethod(Request::METHOD_POST)
            ->setUrl('login/test-token');

        $response = $this
            ->client
            ->request($request);
        if (!$response->isSuccess()) {
            return $response;
        }

        return $response->setData([
            'userInfo' => (new UserInfo())->fromArray($response->getData()),
        ]);
    }
}
