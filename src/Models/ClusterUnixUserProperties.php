<?php

namespace Cyberfusion\ClusterApi\Models;

use Cyberfusion\ClusterApi\Support\Arr;

class ClusterUnixUserProperties extends ClusterModel
{
    private ?int $id = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;
    private ?string $unixUsersHomeDirectory = null;
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

    public function getUnixUsersHomeDirectory(): ?string
    {
        return $this->unixUsersHomeDirectory;
    }

    public function setUnixUsersHomeDirectory(?string $unixUsersHomeDirectory): self
    {
        $this->unixUsersHomeDirectory = $unixUsersHomeDirectory;

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
            ->setUnixUsersHomeDirectory(Arr::get($data, 'unix_users_home_directory'))
            ->setClusterId(Arr::get($data, 'cluster_id'));
    }

    public function toArray(): array
    {
        return [
            'unix_users_home_directory' => $this->getUnixUsersHomeDirectory(),
        ];
    }
}
