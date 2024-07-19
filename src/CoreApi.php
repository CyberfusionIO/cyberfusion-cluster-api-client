<?php

namespace Cyberfusion\CoreApi;

use Cyberfusion\CoreApi\Contracts\Client as ClientContract;
use Cyberfusion\CoreApi\Endpoints\ApiUsers;
use Cyberfusion\CoreApi\Endpoints\Authentication;
use Cyberfusion\CoreApi\Endpoints\BasicAuthenticationRealms;
use Cyberfusion\CoreApi\Endpoints\BorgArchives;
use Cyberfusion\CoreApi\Endpoints\BorgRepositories;
use Cyberfusion\CoreApi\Endpoints\CertificateManagers;
use Cyberfusion\CoreApi\Endpoints\Certificates;
use Cyberfusion\CoreApi\Endpoints\Clusters;
use Cyberfusion\CoreApi\Endpoints\Cmses;
use Cyberfusion\CoreApi\Endpoints\Crons;
use Cyberfusion\CoreApi\Endpoints\CustomConfigs;
use Cyberfusion\CoreApi\Endpoints\CustomConfigSnippets;
use Cyberfusion\CoreApi\Endpoints\Customers;
use Cyberfusion\CoreApi\Endpoints\Daemons;
use Cyberfusion\CoreApi\Endpoints\Databases;
use Cyberfusion\CoreApi\Endpoints\DatabaseUserGrants;
use Cyberfusion\CoreApi\Endpoints\DatabaseUsers;
use Cyberfusion\CoreApi\Endpoints\DomainRouters;
use Cyberfusion\CoreApi\Endpoints\FirewallGroups;
use Cyberfusion\CoreApi\Endpoints\FirewallRules;
use Cyberfusion\CoreApi\Endpoints\FpmPools;
use Cyberfusion\CoreApi\Endpoints\FtpUsers;
use Cyberfusion\CoreApi\Endpoints\HAProxyListens;
use Cyberfusion\CoreApi\Endpoints\HAProxyListensToNodes;
use Cyberfusion\CoreApi\Endpoints\Health;
use Cyberfusion\CoreApi\Endpoints\HostsEntries;
use Cyberfusion\CoreApi\Endpoints\HtpasswdFiles;
use Cyberfusion\CoreApi\Endpoints\HtpasswdUsers;
use Cyberfusion\CoreApi\Endpoints\Logs;
use Cyberfusion\CoreApi\Endpoints\MailAccounts;
use Cyberfusion\CoreApi\Endpoints\MailAliases;
use Cyberfusion\CoreApi\Endpoints\MailDomains;
use Cyberfusion\CoreApi\Endpoints\MailHostnames;
use Cyberfusion\CoreApi\Endpoints\Malwares;
use Cyberfusion\CoreApi\Endpoints\MariaDbEncryptionKeys;
use Cyberfusion\CoreApi\Endpoints\NodeAddons;
use Cyberfusion\CoreApi\Endpoints\Nodes;
use Cyberfusion\CoreApi\Endpoints\PassengerApps;
use Cyberfusion\CoreApi\Endpoints\RedisInstances;
use Cyberfusion\CoreApi\Endpoints\RootSshKeys;
use Cyberfusion\CoreApi\Endpoints\SecurityTxtPolicies;
use Cyberfusion\CoreApi\Endpoints\Sites;
use Cyberfusion\CoreApi\Endpoints\SshKeys;
use Cyberfusion\CoreApi\Endpoints\TaskCollections;
use Cyberfusion\CoreApi\Endpoints\Tombstones;
use Cyberfusion\CoreApi\Endpoints\UnixUsers;
use Cyberfusion\CoreApi\Endpoints\UrlRedirects;
use Cyberfusion\CoreApi\Endpoints\VirtualHosts;

class CoreApi
{
    public function __construct(private ClientContract $client)
    {
    }

    public function apiUsers(): ApiUsers
    {
        return new ApiUsers($this->client);
    }

    public function authentication(): Authentication
    {
        return new Authentication($this->client);
    }

    public function basicAuthenticationRealms(): BasicAuthenticationRealms
    {
        return new BasicAuthenticationRealms($this->client);
    }

    public function borgArchives(): BorgArchives
    {
        return new BorgArchives($this->client);
    }

    public function borgRepositories(): BorgRepositories
    {
        return new BorgRepositories($this->client);
    }

    public function certificates(): Certificates
    {
        return new Certificates($this->client);
    }

    public function certificateManagers(): CertificateManagers
    {
        return new CertificateManagers($this->client);
    }

    public function clusters(): Clusters
    {
        return new Clusters($this->client);
    }

    public function cmses(): Cmses
    {
        return new Cmses($this->client);
    }

    public function crons(): Crons
    {
        return new Crons($this->client);
    }

    public function customers(): Customers
    {
        return new Customers($this->client);
    }

    public function customConfigs(): CustomConfigs
    {
        return new CustomConfigs($this->client);
    }

    public function customConfigSnippets(): CustomConfigSnippets
    {
        return new CustomConfigSnippets($this->client);
    }

    public function databases(): Databases
    {
        return new Databases($this->client);
    }

    public function databaseUsers(): DatabaseUsers
    {
        return new DatabaseUsers($this->client);
    }

    public function databaseUserGrants(): DatabaseUserGrants
    {
        return new DatabaseUserGrants($this->client);
    }

    public function domainRouters(): DomainRouters
    {
        return new DomainRouters($this->client);
    }

    public function firewallGroups(): FirewallGroups
    {
        return new FirewallGroups($this->client);
    }

    public function firewallRules(): FirewallRules
    {
        return new FirewallRules($this->client);
    }

    public function fpmPools(): FpmPools
    {
        return new FpmPools($this->client);
    }

    public function ftpUsers(): FtpUsers
    {
        return new FtpUsers($this->client);
    }

    public function haProxyListens(): HAProxyListens
    {
        return new HAProxyListens($this->client);
    }

    public function haProxyListensToNodes(): HAProxyListensToNodes
    {
        return new HAProxyListensToNodes($this->client);
    }

    public function health(): Health
    {
        return new Health($this->client);
    }

    public function hostsEntries(): HostsEntries
    {
        return new HostsEntries($this->client);
    }

    public function htpasswdFiles(): HtpasswdFiles
    {
        return new HtpasswdFiles($this->client);
    }

    public function htpasswdUsers(): HtpasswdUsers
    {
        return new HtpasswdUsers($this->client);
    }

    public function logs(): Logs
    {
        return new Logs($this->client);
    }

    public function mailAccounts(): MailAccounts
    {
        return new MailAccounts($this->client);
    }

    public function mailAliases(): MailAliases
    {
        return new MailAliases($this->client);
    }

    public function mailDomains(): MailDomains
    {
        return new MailDomains($this->client);
    }

    public function mailHostnames(): MailHostnames
    {
        return new MailHostnames($this->client);
    }

    public function malwares(): Malwares
    {
        return new Malwares($this->client);
    }

    public function mariaDbEncryptionKeys(): MariaDbEncryptionKeys
    {
        return new MariaDbEncryptionKeys($this->client);
    }

    public function nodes(): Nodes
    {
        return new Nodes($this->client);
    }

    public function nodeAddons(): NodeAddons
    {
        return new NodeAddons($this->client);
    }

    public function passengerApps(): PassengerApps
    {
        return new PassengerApps($this->client);
    }

    public function redisInstances(): RedisInstances
    {
        return new RedisInstances($this->client);
    }

    public function rootSshKeys(): RootSshKeys
    {
        return new RootSshKeys($this->client);
    }

    public function securityTxtPolicies(): SecurityTxtPolicies
    {
        return new SecurityTxtPolicies($this->client);
    }

    public function sites(): Sites
    {
        return new Sites($this->client);
    }

    public function sshKeys(): SshKeys
    {
        return new SshKeys($this->client);
    }

    public function taskCollections(): TaskCollections
    {
        return new TaskCollections($this->client);
    }

    public function tombstones(): Tombstones
    {
        return new Tombstones($this->client);
    }

    public function unixUsers(): UnixUsers
    {
        return new UnixUsers($this->client);
    }

    public function urlRedirects(): UrlRedirects
    {
        return new UrlRedirects($this->client);
    }

    public function virtualHosts(): VirtualHosts
    {
        return new VirtualHosts($this->client);
    }

    public function daemons(): Daemons
    {
        return new Daemons($this->client);
    }
}
