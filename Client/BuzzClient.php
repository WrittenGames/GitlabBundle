<?php

namespace WG\GitlabBundle\Client;

use Buzz\Browser;

use WG\GitlabBundle\Client\AbstractClient,
    WG\GitlabBundle\Entity\Access;

class BuzzClient extends AbstractClient
{
    protected $browser;
    
    public function __construct()
    {
        $this->browser = new Browser();
    }
    
    public function get( Access $access, $url )
    {
        $url = $this->buildUrl( $access, $url );
        $response = $this->browser->get( $url )->getContent();
        return json_decode( $response, true );
    }
    
    public function post( Access $access, $url, $data = array()  )
    {
        $url = $this->buildUrl( $access, $url );
        $content = join( "\n", $data );
        $response = $this->browser->post( $url, array(), $content );
    }
    
    public function put( Access $access, $url, $data = array()  )
    {
        $url = $this->buildUrl( $access, $url );
        $content = join( "\n", $data );
        $response = $this->browser->put( $url, array(), $content );
    }
    
    public function delete( Access $access, $url )
    {
        $url = $this->buildUrl( $access, $url );
        $response = $this->browser->delete( $url );
    }
}
