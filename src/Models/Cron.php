<?php

namespace Cyberfusion\CoreApi\Models;

use Cyberfusion\CoreApi\Support\Arr;
use Cyberfusion\CoreApi\Support\Validator;

class Cron extends ClusterModel
{
    private string $name;
    private string $command;
    private ?string $emailAddress = null;
    private string $schedule;
    private int $unixUserId;
    private ?int $nodeId = null;
    private int $errorCount = 1;
    private int $randomDelayMaxSeconds = 10;
    private bool $lockingEnabled = true;
    private bool $isActive = true;
    private ?int $timeoutSeconds = null;
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

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(?string $emailAddress): self
    {
        Validator::value($emailAddress)
            ->nullable()
            ->email()
            ->validate();

        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getSchedule(): string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

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

    public function getNodeId(): ?int
    {
        return $this->nodeId;
    }

    public function setNodeId(?int $nodeId): self
    {
        $this->nodeId = $nodeId;

        return $this;
    }

    public function getErrorCount(): int
    {
        return $this->errorCount;
    }

    public function setErrorCount(int $errorCount): self
    {
        $this->errorCount = $errorCount;

        return $this;
    }

    public function getRandomDelayMaxSeconds(): int
    {
        return $this->randomDelayMaxSeconds;
    }

    public function setRandomDelayMaxSeconds(int $randomDelayMaxSeconds): self
    {
        $this->randomDelayMaxSeconds = $randomDelayMaxSeconds;

        return $this;
    }

    public function getTimeoutSeconds(): ?int
    {
        return $this->timeoutSeconds;
    }

    public function setTimeoutSeconds(?int $timeoutSeconds): self
    {
        Validator::value($timeoutSeconds)
            ->minAmount(0)
            ->nullable()
            ->validate();

        $this->timeoutSeconds = $timeoutSeconds;

        return $this;
    }

    public function isLockingEnabled(): bool
    {
        return $this->lockingEnabled;
    }

    public function setLockingEnabled(bool $lockingEnabled): self
    {
        $this->lockingEnabled = $lockingEnabled;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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
            ->setEmailAddress(Arr::get($data, 'email_address'))
            ->setSchedule(Arr::get($data, 'schedule'))
            ->setUnixUserId(Arr::get($data, 'unix_user_id'))
            ->setNodeId(Arr::get($data, 'node_id'))
            ->setErrorCount(Arr::get($data, 'error_count'))
            ->setRandomDelayMaxSeconds(Arr::get($data, 'random_delay_max_seconds'))
            ->setTimeoutSeconds(Arr::get($data, 'timeout_seconds'))
            ->setLockingEnabled(Arr::get($data, 'locking_enabled'))
            ->setIsActive(Arr::get($data, 'is_active'))
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
            'email_address' => $this->getEmailAddress(),
            'schedule' => $this->getSchedule(),
            'unix_user_id' => $this->getUnixUserId(),
            'node_id' => $this->getNodeId(),
            'error_count' => $this->getErrorCount(),
            'random_delay_max_seconds' => $this->getRandomDelayMaxSeconds(),
            'timeout_seconds' => $this->getTimeoutSeconds(),
            'locking_enabled' => $this->isLockingEnabled(),
            'is_active' => $this->isActive(),
            'id' => $this->getId(),
            'cluster_id' => $this->getClusterId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
