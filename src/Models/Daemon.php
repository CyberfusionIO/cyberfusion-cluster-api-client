<?php

namespace Cyberfusion\ClusterApi\Models;

use Cyberfusion\ClusterApi\Support\Arr;
use Cyberfusion\ClusterApi\Support\Validator;

class Daemon extends ClusterModel
{
    private string $name;
    private string $command;
    private int $unixUserId;
    private ?int $memoryLimit = null;
    private ?int $cpuLimit = null;
    private array $nodesIds;
    private ?int $id = null;
    private ?int $clusterId = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        Validator::value($name)
          ->maxLength(64)
          ->pattern('^[a-z0-9-_]+$')
          ->validate();

        $this->name = $name;

        return $this;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function setCommand(string $command): self
    {
        Validator::value($command)
          ->maxLength(65535)
          ->pattern('^[ -~]+$')
          ->validate();

        $this->command = $command;

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

    public function getCpuLimit(): ?int
    {
        return $this->cpuLimit;
    }

    public function setCpuLimit(?int $cpuLimit): self
    {
        $this->cpuLimit = $cpuLimit;

        return $this;
    }

    public function getMemoryLimit(): ?int
    {
        return $this->memoryLimit;
    }

    public function setMemoryLimit(?int $memoryLimit): self
    {
        $this->memoryLimit = $memoryLimit;

        return $this;
    }

    public function getNodesIds(): array
    {
        return $this->nodesIds;
    }

    public function setNodesIds(array $nodesIds): self
    {
        $this->nodesIds = $nodesIds;

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
          ->setName(Arr::get($data, 'name'))
          ->setCommand(Arr::get($data, 'command'))
          ->setUnixUserId(Arr::get($data, 'unix_user_id'))
          ->setMemoryLimit(Arr::get($data, 'memory_limit'))
          ->setCpuLimit(Arr::get($data, 'cpu_limit'))
          ->setNodesIds(Arr::get($data, 'nodes_ids'))
          ->setId(Arr::get($data, 'id'))
          ->setClusterId(Arr::get($data, 'cluster_id'))
          ->setCreatedAt(Arr::get($data, 'created_at'))
          ->setUpdatedAt(Arr::get($data, 'updated_at'));
    }

    public function toArray(): array
    {
        return [
          'name' => $this->getName(),
          'command' => $this->getCommand(),
          'unix_user_id' => $this->getUnixUserId(),
          'memory_limit' => $this->getMemoryLimit(),
          'cpu_limit' => $this->getCpuLimit(),
          'nodes_ids' => $this->getNodesIds(),
          'id' => $this->getId(),
          'cluster_id' => $this->getClusterId(),
          'created_at' => $this->getCreatedAt(),
          'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
