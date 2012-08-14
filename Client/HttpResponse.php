<?php

namespace WG\GitlabBundle\Client;

class HttpResponse
{
    protected $body;
    protected $statusCode;
    
    /**
     * @param string
     * @param integer
     */
    public function __construct( $body = '', $statusCode = 200 )
    {
        $this->body = $body;
        $this->statusCode = intval( $statusCode );
    }
    
    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
    
    /**
     * @param string
     */
    public function setBody( $body )
    {
        $this->body = $body;
    }
    
    /**
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    /**
     * @param integer
     */
    public function setStatusCode( $statusCode )
    {
        $this->statusCode = intval( $statusCode );
    }
}
