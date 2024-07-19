<?php

namespace Cyberfusion\CoreApi\Models;

use Cyberfusion\CoreApi\Support\Arr;
use Cyberfusion\CoreApi\Support\Validator;

class MailAlias extends ClusterModel
{
    private string $localPart;
    private array $forwardEmailAddresses = [];
    private ?int $mailDomainId = null;
    private ?int $id = null;
    private ?int $clusterId = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    public function getLocalPart(): string
    {
        return $this->localPart;
    }

    public function setLocalPart(string $localPart): self
    {
        Validator::value($localPart)
            ->pattern('^[a-z0-9-.]+$')
            ->maxLength(64)
            ->validate();

        $this->localPart = $localPart;

        return $this;
    }

    public function getForwardEmailAddresses(): array
    {
        return $this->forwardEmailAddresses;
    }

    public function setForwardEmailAddresses(array $forwardEmailAddresses): self
    {
        Validator::value($forwardEmailAddresses)
            ->unique()
            ->validate();

        $this->forwardEmailAddresses = $forwardEmailAddresses;

        return $this;
    }

    public function getMailDomainId(): ?int
    {
        return $this->mailDomainId;
    }

    public function setMailDomainId(?int $mailDomainId): self
    {
        $this->mailDomainId = $mailDomainId;

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
            ->setLocalPart(Arr::get($data, 'local_part'))
            ->setForwardEmailAddresses(Arr::get($data, 'forward_email_addresses', []))
            ->setMailDomainId(Arr::get($data, 'mail_domain_id'))
            ->setId(Arr::get($data, 'id'))
            ->setClusterId(Arr::get($data, 'cluster_id'))
            ->setCreatedAt(Arr::get($data, 'created_at'))
            ->setUpdatedAt(Arr::get($data, 'updated_at'));
    }

    public function toArray(): array
    {
        return [
            'local_part' => $this->getLocalPart(),
            'forward_email_addresses' => $this->getForwardEmailAddresses(),
            'mail_domain_id' => $this->getMailDomainId(),
            'id' => $this->getId(),
            'cluster_id' => $this->getClusterId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
