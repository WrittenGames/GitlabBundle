<?php

namespace WG\GitlabBundle;

class GitlabAPI
{
    protected $privateToken;
    
    public function __construct( $privateToken )
    {
        $this->privateToken = $privateToken;
    }
}
