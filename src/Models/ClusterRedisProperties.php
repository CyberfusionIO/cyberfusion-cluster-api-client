<?php

namespace Cyberfusion\ClusterApi\Models;

use Cyberfusion\ClusterApi\Support\Arr;
use Cyberfusion\ClusterApi\Support\Validator;

class ClusterRedisProperties extends ClusterModel
{
    private ?int $id = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;
    private ?string $redisPassword = null;
    private ?int $redisMemoryLimit = null;
    private ?int $clusterId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getRedisPassword(): ?string
    {
        return $this->redisPassword;
    }

    public function setRedisPassword(?string $redisPassword): self
    {
        $this->redisPassword = $redisPassword;

        return $this;
    }

    public function getRedisMemoryLimit(): ?int
    {
        return $this->redisMemoryLimit;
    }

    public function setRedisMemoryLimit(?int $redisMemoryLimit): self
    {
        Validator::value($redisMemoryLimit)
            ->minAmount(8)
            ->maxAmount(4096)
            ->nullable()
            ->validate();

        $this->redisMemoryLimit = $redisMemoryLimit;

        return $this;
    }

    public function getClusterId(): ?int
    {
        return $this->clusterId;
    }

    public function setClusterId(?int $clusterId): self
    {
        $this->clusterId = $clusterId;

        return $this;
    }

    public function fromArray(array $data): self
    {
        return $this
            ->setId(Arr::get($data, 'id'))
            ->setCreatedAt(Arr::get($data, 'created_at'))
            ->setUpdatedAt(Arr::get($data, 'updated_at'))
            ->setRedisPassword(Arr::get($data, 'redis_password'))
            ->setRedisMemoryLimit(Arr::get($data, 'redis_memory_limit'))
            ->setClusterId(Arr::get($data, 'cluster_id'));
    }

    public function toArray(): array
    {
        return [
            'redis_password' => $this->getRedisPassword(),
            'redis_memory_limit' => $this->getRedisMemoryLimit(),
        ];
    }
}
