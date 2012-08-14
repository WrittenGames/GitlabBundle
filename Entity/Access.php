<?php

namespace WG\GitlabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gitlabaccess")
 */
class Access
{
    const TYPE_GITLAB = 1;
    const TYPE_GITHUB = 2;
    
    const HOST_PROTOCOL_HTTP = 1;
    const HOST_PROTOCOL_HTTPS = 2;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="user_id",type="integer")
     */
    protected $userId;

    /**
     * @ORM\Column(name="remote_userid",type="integer")
     */
    protected $remoteUserId;

    /**
     * @ORM\Column(name="remote_username",type="string")
     */
    protected $remoteUsername;

    /**
     * @ORM\Column(name="api_type",type="integer")
     */
    protected $apiType;

    /**
     * @ORM\Column(name="api_hostprotocol",type="integer")
     */
    protected $apiHostProtocol;

    /**
     * @ORM\Column(name="api_host",type="string")
     */
    protected $apiHost;

    /**
     * @ORM\Column(name="api_version",type="string")
     */
    protected $apiVersion;

    /**
     * @ORM\Column(name="private_token",type="string")
     */
    protected $privateToken;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     */
    public function setUserId( $userId )
    {
        $this->userId = $userId;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set remoteUserId
     *
     * @param integer $remoteUserId
     */
    public function setRemoteUserId( $remoteUserId )
    {
        $this->remoteUserId = $remoteUserId;
    }

    /**
     * Get remoteUserId
     *
     * @return integer 
     */
    public function getRemoteUserId()
    {
        return $this->remoteUserId;
    }

    /**
     * Set remoteUsername
     *
     * @param string $remoteUsername
     */
    public function setRemoteUsername( $remoteUsername )
    {
        $this->remoteUsername = $remoteUsername;
    }

    /**
     * Get remoteUsername
     *
     * @return string 
     */
    public function getRemoteUsername()
    {
        return $this->remoteUsername;
    }

    /**
     * Set apiType
     *
     * @param integer $apiType
     */
    public function setApiType( $apiType )
    {
        $this->apiType = $apiType;
    }

    /**
     * Get apiType
     *
     * @return integer 
     */
    public function getApiType()
    {
        return $this->apiType;
    }

    /**
     * Get apiType in human readable form
     *
     * @return string 
     */
    public function getApiTypeHumanReadable()
    {
        switch ( $this->apiType )
        {
            case self::TYPE_GITLAB: return 'Gitlab';
            case self::TYPE_GITHUB: return 'Github';
        }
    }

    /**
     * Set apiHostProtocol
     *
     * @param integer $apiHostProtocol
     */
    public function setApiHostProtocol( $apiHostProtocol )
    {
        $this->apiHostProtocol = $apiHostProtocol;
    }

    /**
     * Get apiHostProtocol
     *
     * @return integer 
     */
    public function getApiHostProtocol()
    {
        return $this->apiHostProtocol;
    }
    
    /**
     * Get apiHostProtocol in human readable form
     *
     * @return string 
     */
    public function getApiHostProtocolHumanReadable()
    {
        switch ( $this->apiHostProtocol )
        {
            case self::HOST_PROTOCOL_HTTP: return 'http';
            case self::HOST_PROTOCOL_HTTPS: return 'https';
        }
    }

    /**
     * Set apiHost
     *
     * @param string $apiHost
     */
    public function setApiHost( $apiHost )
    {
        //////////////////////////////////////////
        // Make sure there is no trailing slash //
        //////////////////////////////////////////
        if ( substr( $apiHost, -1 ) == '/' ) $apiHost = substr( $apiHost, 0, -1 );
        //////////////////////////////////////////////
        // Make sure there is no hardcoded protocol //
        //////////////////////////////////////////////
        $needle = '://';
        $pos = strpos( $apiHost, $needle );
        if ( $pos !== false )
        {
            $offset = $pos + strlen( $needle );
            $apiHost = substr( $apiHost, $offset );
        }
        //////////////////////////////
        // Set cleaned-up host name //
        //////////////////////////////
        $this->apiHost = $apiHost;
    }

    /**
     * Get apiHost
     *
     * @return string 
     */
    public function getApiHost()
    {
        return $this->apiHost;
    }

    /**
     * Set apiVersion
     *
     * @param string $apiVersion
     */
    public function setApiVersion( $apiVersion )
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * Get apiVersion
     *
     * @return string 
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * Set privateToken
     *
     * @param string $privateToken
     */
    public function setPrivateToken( $privateToken )
    {
        $this->privateToken = $privateToken;
    }

    /**
     * Get privateToken
     *
     * @return string 
     */
    public function getPrivateToken()
    {
        return $this->privateToken;
    }
    
    /**
     * Create string representation of Access object
     *
     * @return string 
     */
    public function __toString()
    {
        $str = $this->getApiHost();
        if ( null !== $this->getRemoteUsername() )
        {
            $str = $this->getRemoteUsername() . ' on ' . $str;
        }
        return $str;
    }
}
