<?php

namespace Cyberfusion\CoreApi\Models;

use Cyberfusion\CoreApi\Enums\VirtualHostServerSoftwareName;
use Cyberfusion\CoreApi\Support\Arr;
use Cyberfusion\CoreApi\Support\Validator;

class CustomConfig extends ClusterModel
{
    private ?string $name = null;
    private ?string $serverSoftwareName = null;
    private ?string $contents = null;
    private ?int $clusterId = null;
    private ?int $id = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        Validator::value($name)
            ->minLength(1)
            ->maxLength(128)
            ->pattern('^[a-z0-9-_]+$')
            ->validate();

        $this->name = $name;

        return $this;
    }

    public function getServerSoftwareName(): ?string
    {
        return $this->serverSoftwareName;
    }

    public function setServerSoftwareName(string $serverSoftwareName): self
    {
        Validator::value($serverSoftwareName)
            ->valueIn([VirtualHostServerSoftwareName::SERVER_SOFTWARE_NGINX])
            ->validate();

        $this->serverSoftwareName = $serverSoftwareName;

        return $this;
    }

    public function getContents(): ?string
    {
        return $this->contents;
    }

    public function setContents(string $contents): self
    {
        Validator::value($contents)
            ->minLength(1)
            ->maxLength(65535)
            ->pattern('^[ -~\n]+$')
            ->validate();

        $this->contents = $contents;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getClusterId(): ?int
    {
        return $this->clusterId;
    }

    public function setClusterId(int $clusterId): self
    {
        $this->clusterId = $clusterId;

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

    public function fromArray(array $data): self
    {
        return $this
            ->setName(Arr::get($data, 'name'))
            ->setServerSoftwareName(Arr::get($data, 'server_software_name'))
            ->setContents(Arr::get($data, 'contents'))
            ->setId(Arr::get($data, 'id'))
            ->setClusterId(Arr::get($data, 'cluster_id'))
            ->setCreatedAt(Arr::get($data, 'created_at'))
            ->setUpdatedAt(Arr::get($data, 'updated_at'));
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'server_software_name' => $this->getServerSoftwareName(),
            'contents' => $this->getContents(),
            'id' => $this->getId(),
            'cluster_id' => $this->getClusterId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
