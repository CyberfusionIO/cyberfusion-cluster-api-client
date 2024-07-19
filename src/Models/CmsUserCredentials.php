<?php

namespace Cyberfusion\CoreApi\Models;

use Cyberfusion\CoreApi\Support\Arr;
use Cyberfusion\CoreApi\Support\Validator;

class CmsUserCredentials extends ClusterModel
{
    private string $password;

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        Validator::value($password)
            ->minLength(24)
            ->maxLength(255)
            ->pattern('^[ -~]+$')
            ->validate();

        $this->password = $password;

        return $this;
    }

    public function fromArray(array $data): self
    {
        return $this
            ->setPassword(Arr::get($data, 'password'));
    }

    public function toArray(): array
    {
        return [
            'password' => $this->getPassword(),
        ];
    }
}
