<?php

namespace WG\GitlabBundle\Client;

use WG\GitlabBundle\Entity\Access;

interface ClientInterface
{
    function get( Access $access, $url );
    function post( Access $access, $url, $data = array()  );
    function put( Access $access, $url, $data = array()  );
    function delete( Access $access, $url );
}
