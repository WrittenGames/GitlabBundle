<?php

namespace WG\GitlabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gitlabaccess")
 */
class Access
{
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
     * @ORM\Column(name="gitlab_userid",type="integer")
     */
    protected $gitlabUserId;

    /**
     * @ORM\Column(name="gitlab_username",type="string")
     */
    protected $gitlabUserName;

    /**
     * @ORM\Column(name="gitlab_host",type="string")
     */
    protected $gitlabHost;

    /**
     * @ORM\Column(name="gitlab_apiversion",type="string")
     */
    protected $gitlabApiVersion;

    /**
     * @ORM\Column(name="gitlab_token",type="string")
     */
    protected $gitlabToken;

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
     * Set gitlabUserId
     *
     * @param integer $gitlabUserId
     */
    public function setGitlabUserId( $gitlabUserId )
    {
        $this->gitlabUserId = $gitlabUserId;
    }

    /**
     * Get gitlabUserId
     *
     * @return integer 
     */
    public function getGitlabUserId()
    {
        return $this->gitlabUserId;
    }

    /**
     * Set gitlabUserName
     *
     * @param string $gitlabUserName
     */
    public function setGitlabUserName( $gitlabUserName )
    {
        $this->gitlabUserName = $gitlabUserName;
    }

    /**
     * Get gitlabUserName
     *
     * @return string 
     */
    public function getGitlabUserName()
    {
        return $this->gitlabUserName;
    }

    /**
     * Set gitlabHost
     *
     * @param string $gitlabHost
     */
    public function setGitlabHost( $gitlabHost )
    {
        $this->gitlabHost = $gitlabHost;
    }

    /**
     * Get gitlabHost
     *
     * @return string 
     */
    public function getGitlabHost()
    {
        return $this->gitlabHost;
    }

    /**
     * Set gitlabApiVersion
     *
     * @param string $gitlabApiVersion
     */
    public function setGitlabApiVersion( $gitlabApiVersion )
    {
        $this->gitlabApiVersion = $gitlabApiVersion;
    }

    /**
     * Get gitlabApiVersion
     *
     * @return string 
     */
    public function getGitlabApiVersion()
    {
        return $this->gitlabApiVersion;
    }

    /**
     * Set gitlabToken
     *
     * @param string $gitlabToken
     */
    public function setGitlabToken( $gitlabToken )
    {
        $this->gitlabToken = $gitlabToken;
    }

    /**
     * Get gitlabToken
     *
     * @return string 
     */
    public function getGitlabToken()
    {
        return $this->gitlabToken;
    }
    
    public function __toString()
    {
        $str = $this->getGitlabHost();
        if ( null !== $this->getGitlabUserName() )
        {
            $str .= ' (' . $this->getGitlabUserName() . ')';
        }
        return $str;
    }
}
