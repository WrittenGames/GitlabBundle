<?php

namespace WG\GitlabBundle\Client;

use WG\GitlabBundle\Entity\Access;

interface ClientInterface
{
    protected function get( Access $access, $url );
    protected function post( Access $access, $url, $data = array()  );
    protected function put( Access $access, $url, $data = array()  );
    protected function delete( Access $access, $url );
}
