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
        return $protocol . $host . 'api/' . $version . '/' . $url . '?private_token=' . $token;
    }
    
    //public protected function delete( Access $access, $url ) {}

    //public protected function get( Access $access, $url ) {}

    //public protected function post( Access $access, $url, $data = array() ) {}

    //public protected function put( Access $access, $url, $data = array() ) {}
}
