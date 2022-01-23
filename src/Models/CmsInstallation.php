<?php

namespace Vdhicts\Cyberfusion\ClusterApi\Models;

use Illuminate\Support\Arr;
use Vdhicts\Cyberfusion\ClusterApi\Contracts\Model;

class CmsInstallation extends ClusterModel implements Model
{
    private string $databaseName;
    private string $databaseUserName;
    private string $databaseUserPassword;
    private string $databaseHost;
    private string $siteTitle;
    private string $siteUrl;
    private string $locale;
    private string $version;
    private string $adminUsername;
    private string $adminPassword;
    private string $adminEmailAddress;

    public function getDatabaseName(): string
    {
        return $this->databaseName;
    }

    public function setDatabaseName(string $databaseName): CmsInstallation
    {
        $this->validate($databaseName, [
            'length_max' => 63,
            'pattern' => '^[a-zA-Z0-9-_]+$',
        ]);

        $this->databaseName = $databaseName;

        return $this;
    }

    public function getDatabaseUserName(): string
    {
        return $this->databaseUserName;
    }

    public function setDatabaseUserName(string $databaseUserName): CmsInstallation
    {
        $this->validate($databaseUserName, [
            'length_max' => 63,
            'pattern' => '^[a-zA-Z0-9-_]+$',
        ]);

        $this->databaseUserName = $databaseUserName;

        return $this;
    }

    public function getDatabaseUserPassword(): string
    {
        return $this->databaseUserPassword;
    }

    public function setDatabaseUserPassword(string $databaseUserPassword): CmsInstallation
    {
        $this->validate($databaseUserPassword, [
            'length_min' => 1,
        ]);

        $this->databaseUserPassword = $databaseUserPassword;

        return $this;
    }

    public function getDatabaseHost(): string
    {
        return $this->databaseHost;
    }

    public function setDatabaseHost(string $databaseHost): CmsInstallation
    {
        $this->validate($databaseHost, [
            'ip',
        ]);

        $this->databaseHost = $databaseHost;

        return $this;
    }

    public function getSiteTitle(): string
    {
        return $this->siteTitle;
    }

    public function setSiteTitle(string $siteTitle): CmsInstallation
    {
        $this->validate($siteTitle, [
            'length_max' => 253,
            'pattern' => '^[a-zA-Z0-9-_ ]+$',
        ]);

        $this->siteTitle = $siteTitle;

        return $this;
    }

    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    public function setSiteUrl(string $siteUrl): CmsInstallation
    {
        $this->validate($siteUrl, [
            'length_max' => 2083,
        ]);

        $this->siteUrl = $siteUrl;

        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): CmsInstallation
    {
        $this->validate($locale, [
            'length_max' => 15,
            'pattern' => '^[a-zA-Z_]+$',
        ]);

        $this->locale = $locale;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): CmsInstallation
    {
        $this->validate($version, [
            'length_max' => 6,
            'pattern' => '^[0-9.]+$',
        ]);

        $this->version = $version;

        return $this;
    }

    public function getAdminUsername(): string
    {
        return $this->adminUsername;
    }

    public function setAdminUsername(string $adminUsername): CmsInstallation
    {
        $this->validate($adminUsername, [
            'length_max' => 60,
            'pattern' => '^[a-zA-Z0-9-_]+$',
        ]);

        $this->adminUsername = $adminUsername;

        return $this;
    }

    public function getAdminPassword(): string
    {
        return $this->adminPassword;
    }

    public function setAdminPassword(string $adminPassword): CmsInstallation
    {
        $this->validate($adminPassword, [
            'length_min' => 1,
        ]);

        $this->adminPassword = $adminPassword;

        return $this;
    }

    public function getAdminEmailAddress(): string
    {
        return $this->adminEmailAddress;
    }

    public function setAdminEmailAddress(string $adminEmailAddress): CmsInstallation
    {
        $this->validate($adminEmailAddress, [
            'email',
        ]);

        $this->adminEmailAddress = $adminEmailAddress;

        return $this;
    }

    public function fromArray(array $data): CmsInstallation
    {
        return $this
            ->setDatabaseName(Arr::get($data, 'database_name'))
            ->setDatabaseUserName(Arr::get($data, 'database_user_name'))
            ->setDatabaseUserPassword(Arr::get($data, 'database_user_password'))
            ->setDatabaseHost(Arr::get($data, 'database_host'))
            ->setSiteTitle(Arr::get($data, 'site_title'))
            ->setSiteUrl(Arr::get($data, 'site_url'))
            ->setLocale(Arr::get($data, 'locale'))
            ->setVersion(Arr::get($data, 'version'))
            ->setAdminUsername(Arr::get($data, 'admin_username'))
            ->setAdminPassword(Arr::get($data, 'admin_password'))
            ->setAdminEmailAddress(Arr::get($data, 'admin_email_address'));
    }

    public function toArray(): array
    {
        return [
            'database_name' => $this->getDatabaseName(),
            'database_user_name' => $this->getDatabaseUserName(),
            'database_user_password' => $this->getDatabaseUserPassword(),
            'database_host' => $this->getDatabaseHost(),
            'site_title' => $this->getSiteTitle(),
            'site_url' => $this->getSiteUrl(),
            'locale' => $this->getLocale(),
            'version' => $this->getVersion(),
            'admin_username' => $this->getAdminUsername(),
            'admin_password' => $this->getAdminPassword(),
            'admin_email_address' => $this->getAdminEmailAddress(),
        ];
    }
}
