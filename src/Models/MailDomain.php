<?php

namespace Cyberfusion\CoreApi\Models;

use Cyberfusion\CoreApi\Support\Arr;
use Cyberfusion\CoreApi\Support\Validator;

class MailDomain extends ClusterModel
{
    private string $domain;
    private array $catchAllForwardEmailAddresses = [];
    private bool $isLocal = true;
    private int $unixUserId;
    private ?int $id = null;
    private ?int $clusterId = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getCatchAllForwardEmailAddresses(): array
    {
        return $this->catchAllForwardEmailAddresses;
    }

    public function setCatchAllForwardEmailAddresses(array $catchAllForwardEmailAddresses): self
    {
        Validator::value($catchAllForwardEmailAddresses)
            ->unique()
            ->validate();

        $this->catchAllForwardEmailAddresses = $catchAllForwardEmailAddresses;

        return $this;
    }

    public function isLocal(): bool
    {
        return $this->isLocal;
    }

    public function setIsLocal(bool $isLocal): self
    {
        $this->isLocal = $isLocal;

        return $this;
    }

    public function getUnixUserId(): int
    {
        return $this->unixUserId;
    }

    public function setUnixUserId(int $unixUserId): self
    {
        $this->unixUserId = $unixUserId;

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

    public function setClusterId(?int $clusterId): self
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
            ->setDomain(Arr::get($data, 'domain'))
            ->setCatchAllForwardEmailAddresses(Arr::get($data, 'catch_all_forward_email_addresses', []))
            ->setIsLocal(Arr::get($data, 'is_local'))
            ->setUnixUserId(Arr::get($data, 'unix_user_id'))
            ->setId(Arr::get($data, 'id'))
            ->setClusterId(Arr::get($data, 'cluster_id'))
            ->setCreatedAt(Arr::get($data, 'created_at'))
            ->setUpdatedAt(Arr::get($data, 'updated_at'));
    }

    public function toArray(): array
    {
        return [
            'domain' => $this->getDomain(),
            'catch_all_forward_email_addresses' => $this->getCatchAllForwardEmailAddresses(),
            'is_local' => $this->isLocal(),
            'unix_user_id' => $this->getUnixUserId(),
            'id' => $this->getId(),
            'cluster_id' => $this->getClusterId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
