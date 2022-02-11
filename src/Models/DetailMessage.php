<?php

namespace Vdhicts\Cyberfusion\ClusterApi\Models;

use Vdhicts\Cyberfusion\ClusterApi\Contracts\Model;
use Vdhicts\Cyberfusion\ClusterApi\Support\Arr;

class DetailMessage extends ClusterModel implements Model
{
    private string $detail;

    public function getDetail(): string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): DetailMessage
    {
        $this->detail = $detail;

        return $this;
    }

    public function fromArray(array $data): DetailMessage
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
