<?php

namespace Cyberfusion\ClusterApi\Models;

use Cyberfusion\ClusterApi\Enums\DatabaseUserGrantPrivilegeName;
use Cyberfusion\ClusterApi\Support\Arr;
use Cyberfusion\ClusterApi\Support\Validator;

class DatabaseUserGrant extends ClusterModel
{
    private int $databaseId;
    private int $databaseUserId;
    private ?string $tableName = null;
    private string $privilegeName = DatabaseUserGrantPrivilegeName::ALL;
    private ?int $id = null;
    private ?int $clusterId = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    public function getDatabaseId(): int
    {
        return $this->databaseId;
    }

    public function setDatabaseId(int $databaseId): self
    {
        $this->databaseId = $databaseId;

        return $this;
    }

    public function getDatabaseUserId(): int
    {
        return $this->databaseUserId;
    }

    public function setDatabaseUserId(int $databaseUserId): self
    {
        $this->databaseUserId = $databaseUserId;

        return $this;
    }

    public function getTableName(): ?string
    {
        return $this->tableName;
    }

    public function setTableName(?string $tableName = null): self
    {
        Validator::value($tableName)
            ->maxLength(64)
            ->pattern('^[a-zA-Z0-9-_]+$')
            ->nullable()
            ->validate();

        $this->tableName = $tableName;

        return $this;
    }

    public function getPrivilegeName(): string
    {
        return $this->privilegeName;
    }

    public function setPrivilegeName(string $privilegeName): self
    {
        Validator::value($privilegeName)
            ->valueIn(DatabaseUserGrantPrivilegeName::AVAILABLE)
            ->validate();

        $this->privilegeName = $privilegeName;

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
            ->setDatabaseId(Arr::get($data, 'database_id'))
            ->setDatabaseUserId(Arr::get($data, 'database_user_id'))
            ->setTableName(Arr::get($data, 'table_name'))
            ->setPrivilegeName(Arr::get($data, 'privilege_name', DatabaseUserGrantPrivilegeName::ALL))
            ->setId(Arr::get($data, 'id'))
            ->setClusterId(Arr::get($data, 'cluster_id'))
            ->setCreatedAt(Arr::get($data, 'created_at'))
            ->setUpdatedAt(Arr::get($data, 'updated_at'));
    }

    public function toArray(): array
    {
        return [
            'database_id' => $this->getDatabaseId(),
            'database_user_id' => $this->getDatabaseUserId(),
            'table_name' => $this->getTableName(),
            'privilege_name' => $this->getPrivilegeName(),
            'id' => $this->getId(),
            'cluster_id' => $this->getClusterId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
