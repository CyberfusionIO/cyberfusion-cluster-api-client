<?php

namespace Cyberfusion\CoreApi\Models;

use Cyberfusion\CoreApi\Support\Arr;
use Cyberfusion\CoreApi\Support\Validator;

class DetailMessage extends ClusterModel
{
    private string $detail;

    public function getDetail(): string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): self
    {
        Validator::value($detail)
            ->maxLength(255)
            ->pattern('^[ -~]+$')
            ->validate();

        $this->detail = $detail;

        return $this;
    }

    public function fromArray(array $data): self
    {
        return $this->setDetail(Arr::get($data, 'detail', ''));
    }

    public function toArray(): array
    {
        return [
            'detail' => $this->getDetail(),
        ];
    }
}
