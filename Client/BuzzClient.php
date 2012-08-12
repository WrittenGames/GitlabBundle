<?php

namespace WG\GitlabBundle\Client;

use WG\GitlabBundle\Client\AbstractClient,
    WG\GitlabBundle\Entity\Access;

class BuzzClient extends AbstractClient
{
    protected $browser;
    
    public function __construct()
    {
        $this->browser = new Buzz\Browser();
    }
    
    protected function get( Access $access, $url )
    {
        $url = $this->buildUrl( $access, $url );
        return json_decode( $this->browser->get( $url )->getContent() );
    }
    
    protected function post( Access $access, $url, $data = array()  )
    {
        $url = $this->buildUrl( $access, $url );
        $content = join( "\n", $data );
        $response = $this->browser->post( $url, array(), $content );
    }
    
    protected function put( Access $access, $url, $data = array()  )
    {
        $url = $this->buildUrl( $access, $url );
        $content = join( "\n", $data );
        $response = $this->browser->put( $url, array(), $content );
    }
    
    protected function delete( Access $access, $url )
    {
        $url = $this->buildUrl( $access, $url );
        $response = $this->browser->delete( $url );
    }
}
