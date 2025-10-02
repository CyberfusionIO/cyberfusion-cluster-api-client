<?php

namespace Cyberfusion\ClusterApi\Models;

use ArrayObject;
use Cyberfusion\ClusterApi\Support\Arr;

class ClusterPhpProperties extends ClusterModel
{
    private ?int $id = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;
    private array $phpVersions = [];
    private array $customPhpModulesNames = [];
    private array $phpSettings = [];
    private ?bool $phpIoncubeEnabled = null;
    private ?bool $phpSessionSpreadEnabled = null;
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

    public function getPhpVersions(): array
    {
        return $this->phpVersions;
    }

    public function setPhpVersions(array $phpVersions): self
    {
        $this->phpVersions = $phpVersions;

        return $this;
    }

    public function getCustomPhpModulesNames(): array
    {
        return $this->customPhpModulesNames;
    }

    public function setCustomPhpModulesNames(array $customPhpModulesNames): self
    {
        $this->customPhpModulesNames = $customPhpModulesNames;

        return $this;
    }

    public function getPhpSettings(): array
    {
        return $this->phpSettings;
    }

    public function setPhpSettings(array $phpSettings): self
    {
        $this->phpSettings = $phpSettings;

        return $this;
    }

    public function isPhpIoncubeEnabled(): ?bool
    {
        return $this->phpIoncubeEnabled;
    }

    public function setPhpIoncubeEnabled(?bool $phpIoncubeEnabled): self
    {
        $this->phpIoncubeEnabled = $phpIoncubeEnabled;

        return $this;
    }

    public function isPhpSessionSpreadEnabled(): ?bool
    {
        return $this->phpSessionSpreadEnabled;
    }

    public function setPhpSessionSpreadEnabled(?bool $phpSessionSpreadEnabled): self
    {
        $this->phpSessionSpreadEnabled = $phpSessionSpreadEnabled;

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
            ->setPhpVersions(Arr::get($data, 'php_versions', []))
            ->setCustomPhpModulesNames(Arr::get($data, 'custom_php_modules_names', []))
            ->setPhpSettings(Arr::get($data, 'php_settings', []))
            ->setPhpIoncubeEnabled(Arr::get($data, 'php_ioncube_enabled'))
            ->setPhpSessionSpreadEnabled(Arr::get($data, 'php_session_spread_enabled'))
            ->setClusterId(Arr::get($data, 'cluster_id'));
    }

    public function toArray(): array
    {
        return [
            'php_versions' => $this->getPhpVersions(),
            'custom_php_modules_names' => $this->getCustomPhpModulesNames(),
            'php_settings' => new ArrayObject($this->getPhpSettings()),
            'php_ioncube_enabled' => $this->isPhpIoncubeEnabled(),
            'php_sessions_spread_enabled' => $this->isPhpSessionSpreadEnabled(),
        ];
    }
}
