<?php

namespace WG\GitlabBundle\Client;

use WG\GitlabBundle\Client\ClientInterface,
    WG\GitlabBundle\Entity\Access;

abstract class AbstractClient implements ClientInterface
{
    protected function buildUrl( Access $access, $url )
    {
        $version = $access->getGitlabApiVersion();
        $token = $access->getGitlabToken();
        $host = $access->getGitlabHost();
        $protocol = substr( $host, 0, 4 ) == 'http' ? '' : 'http://';
        if ( substr( $host, -1 ) != '/' ) $host .= '/';
        $prefix = 'api/' . $version;
        return $protocol . $host . $prefix . $url . '?private_token=' . $token;
    }
}
