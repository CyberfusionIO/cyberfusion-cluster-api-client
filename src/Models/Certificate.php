<?php

namespace Cyberfusion\CoreApi\Models;

use Cyberfusion\CoreApi\Support\Arr;
use Cyberfusion\CoreApi\Support\Validator;

class Certificate extends ClusterModel
{
    private string $mainCommonName = '';
    private array $commonNames = [];
    private string $certificate;
    private string $caChain;
    private string $privateKey;
    private ?string $expiresAt = null;
    private ?int $id = null;
    private ?int $clusterId = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    public function getMainCommonName(): string
    {
        return $this->mainCommonName;
    }

    public function setMainCommonName(string $mainCommonName): self
    {
        $this->mainCommonName = $mainCommonName;

        return $this;
    }

    public function getCommonNames(): array
    {
        return $this->commonNames;
    }

    public function setCommonNames(array $commonNames): self
    {
        Validator::value($commonNames)
            ->unique()
            ->validate();

        $this->commonNames = array_unique($commonNames);

        return $this;
    }

    public function getCertificate(): string
    {
        return $this->certificate;
    }

    public function setCertificate(string $certificate): self
    {
        Validator::value($certificate)
            ->maxLength(65535)
            ->pattern('^[a-zA-Z0-9-_\+\/=\n ]+$')
            ->validate();

        $this->certificate = $certificate;

        return $this;
    }

    public function getCaChain(): string
    {
        return $this->caChain;
    }

    public function setCaChain(string $caChain): self
    {
        Validator::value($caChain)
            ->maxLength(65535)
            ->pattern('^[a-zA-Z0-9-_\+\/=\n ]+$')
            ->validate();

        $this->caChain = $caChain;

        return $this;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    public function setPrivateKey(string $privateKey): self
    {
        Validator::value($privateKey)
            ->maxLength(65535)
            ->pattern('^[a-zA-Z0-9-_\+\/=\n ]+$')
            ->validate();

        $this->privateKey = $privateKey;

        return $this;
    }

    public function getExpiresAt(): ?string
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?string $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

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
            ->setMainCommonName(Arr::get($data, 'main_common_name', ''))
            ->setCommonNames(Arr::get($data, 'common_names', []))
            ->setCertificate(Arr::get($data, 'certificate'))
            ->setCaChain(Arr::get($data, 'ca_chain'))
            ->setPrivateKey(Arr::get($data, 'private_key'))
            ->setExpiresAt(Arr::get($data, 'expires_at'))
            ->setId(Arr::get($data, 'id'))
            ->setClusterId(Arr::get($data, 'cluster_id'))
            ->setCreatedAt(Arr::get($data, 'created_at'))
            ->setUpdatedAt(Arr::get($data, 'updated_at'));
    }

    public function toArray(): array
    {
        return [
            'main_common_name' => $this->getMainCommonName(),
            'common_names' => $this->getCommonNames(),
            'certificate' => $this->getCertificate(),
            'ca_chain' => $this->getCaChain(),
            'private_key' => $this->getPrivateKey(),
            'expires_at' => $this->getExpiresAt(),
            'id' => $this->getId(),
            'cluster_id' => $this->getClusterId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
