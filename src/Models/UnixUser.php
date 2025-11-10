<?php

namespace Cyberfusion\ClusterApi\Models;

use Cyberfusion\ClusterApi\Enums\ShellName;
use Cyberfusion\ClusterApi\Support\Arr;
use Cyberfusion\ClusterApi\Support\Validator;

class UnixUser extends ClusterModel
{
    private string $username;
    private ?string $homeDirectory = null;
    private ?string $sshDirectory = null;
    private ?string $virtualHostsDirectory = null;
    private ?bool $shellIsNamespaced = null;
    private ?string $mailDomainsDirectory = null;
    private int $clusterId;
    private ?string $password = null;
    private string $shellName = ShellName::BASH;
    private bool $recordUsageFiles = false;
    private ?string $defaultPhpVersion = null;
    private ?string $defaultNodejsVersion = null;
    private ?string $description = null;
    private ?int $id = null;
    private ?int $unixId = null;
    private ?string $createdAt = null;
    private ?string $updatedAt = null;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        Validator::value($username)
            ->maxLength(32)
            ->pattern('^[a-z0-9-_]+$')
            ->validate();

        $this->username = $username;

        return $this;
    }

    public function getHomeDirectory(): ?string
    {
        return $this->homeDirectory;
    }

    public function setHomeDirectory(?string $homeDirectory): self
    {
        Validator::value($homeDirectory)
            ->nullable()
            ->path()
            ->validate();

        $this->homeDirectory = $homeDirectory;

        return $this;
    }

    public function getSshDirectory(): ?string
    {
        return $this->sshDirectory;
    }

    public function setSshDirectory(?string $sshDirectory): self
    {
        Validator::value($sshDirectory)
            ->nullable()
            ->path()
            ->validate();

        $this->sshDirectory = $sshDirectory;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password = null): self
    {
        Validator::value($password)
            ->minLength(24)
            ->maxLength(255)
            ->pattern('^[ -~]+$')
            ->nullable()
            ->validate();

        $this->password = $password;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        Validator::value($description)
            ->nullable()
            ->pattern('^[a-zA-Z0-9-_ ]+$')
            ->maxLength(255)
            ->validate();

        $this->description = $description;

        return $this;
    }

    public function getDefaultPhpVersion(): ?string
    {
        return $this->defaultPhpVersion;
    }

    public function setDefaultPhpVersion(?string $defaultPhpVersion): self
    {
        $this->defaultPhpVersion = $defaultPhpVersion;

        return $this;
    }

    public function getDefaultNodejsVersion(): ?string
    {
        return $this->defaultNodejsVersion;
    }

    public function setDefaultNodejsVersion(?string $defaultNodejsVersion): self
    {
        Validator::value($defaultNodejsVersion)
            ->nullable()
            ->pattern('^[0-9]{1,2}\.[0-9]{1,2}$')
            ->validate();

        $this->defaultNodejsVersion = $defaultNodejsVersion;

        return $this;
    }

    public function getVirtualHostsDirectory(): ?string
    {
        return $this->virtualHostsDirectory;
    }

    public function setVirtualHostsDirectory(?string $virtualHostsDirectory): self
    {
        Validator::value($virtualHostsDirectory)
            ->nullable()
            ->path()
            ->validate();

        $this->virtualHostsDirectory = $virtualHostsDirectory;

        return $this;
    }

    public function getMailDomainsDirectory(): ?string
    {
        return $this->mailDomainsDirectory;
    }

    public function setMailDomainsDirectory(?string $mailDomainsDirectory): self
    {
        Validator::value($mailDomainsDirectory)
            ->nullable()
            ->path()
            ->validate();

        $this->mailDomainsDirectory = $mailDomainsDirectory;

        return $this;
    }

    public function getShellName(): string
    {
        return $this->shellName;
    }

    public function setShellName(string $shellName): self
    {
        Validator::value($shellName)
            ->valueIn(ShellName::AVAILABLE)
            ->validate();

        $this->shellName = $shellName;

        return $this;
    }

    public function getShellIsNamespaced(): ?bool
    {
        return $this->shellIsNamespaced;
    }

    public function setShellIsNamespaced(?bool $shellIsNamespaced): self
    {
        $this->shellIsNamespaced = $shellIsNamespaced;

        return $this;
    }

    public function getRecordUsageFiles(): bool
    {
        return $this->recordUsageFiles;
    }

    public function setRecordUsageFiles(bool $recordUsageFiles): self
    {
        $this->recordUsageFiles = $recordUsageFiles;

        return $this;
    }

    public function getClusterId(): int
    {
        return $this->clusterId;
    }

    public function setClusterId(int $clusterId): self
    {
        $this->clusterId = $clusterId;

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

    public function getUnixId(): ?int
    {
        return $this->unixId;
    }

    public function setUnixId(?int $unixId): self
    {
        $this->unixId = $unixId;

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
            ->setUsername(Arr::get($data, 'username'))
            ->setPassword(Arr::get($data, 'password'))
            ->setHomeDirectory(Arr::get($data, 'home_directory'))
            ->setSshDirectory(Arr::get($data, 'ssh_directory'))
            ->setDescription(Arr::get($data, 'description'))
            ->setDefaultPhpVersion(Arr::get($data, 'default_php_version'))
            ->setDefaultNodejsVersion(Arr::get($data, 'default_nodejs_version'))
            ->setVirtualHostsDirectory(Arr::get($data, 'virtual_hosts_directory'))
            ->setMailDomainsDirectory(Arr::get($data, 'mail_domains_directory'))
            ->setShellName(Arr::get($data, 'shell_name', ShellName::BASH))
            ->setShellIsNamespaced(Arr::get($data, 'shell_is_namespaced'))
            ->setRecordUsageFiles(Arr::get($data, 'record_usage_files', false))
            ->setUnixId(Arr::get($data, 'unix_id'))
            ->setId(Arr::get($data, 'id'))
            ->setClusterId(Arr::get($data, 'cluster_id'))
            ->setCreatedAt(Arr::get($data, 'created_at'))
            ->setUpdatedAt(Arr::get($data, 'updated_at'));
    }

    public function toArray(): array
    {
        return [
            'username' => $this->getUsername(),
            'home_directory' => $this->getHomeDirectory(),
            'ssh_directory' => $this->getSshDirectory(),
            'virtual_hosts_directory' => $this->getVirtualHostsDirectory(),
            'shell_is_namespaced' => $this->getShellIsNamespaced(),
            'mail_domains_directory' => $this->getMailDomainsDirectory(),
            'cluster_id' => $this->getClusterId(),
            'password' => $this->getPassword(),
            'shell_name' => $this->getShellName(),
            'record_usage_files' => $this->getRecordUsageFiles(),
            'default_php_version' => $this->getDefaultPhpVersion(),
            'default_nodejs_version' => $this->getDefaultNodejsVersion(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'unix_id' => $this->getUnixId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
