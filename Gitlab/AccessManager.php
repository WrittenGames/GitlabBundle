<?php

namespace WG\GitlabBundle\Gitlab;

use Symfony\Component\Security\Core\SecurityContextInterface;

use Doctrine\Common\Persistence\ObjectManager;

use WG\GitlabBundle\Client\ClientInterface,
    WG\GitlabBundle\Entity\Access,
    WG\GitlabBundle\Gitlab\API;

class AccessManager
{
    protected $om;
    protected $sec;
    protected $api;
    protected $userId;
    
    public function __construct( ObjectManager $om, SecurityContextInterface $sec, API $api )
    {
        $this->om = $om;
        $this->sec = $sec;
        $this->api = $api;
    }
    
    public function createAccessObject()
    {
        $access = new Access();
        $access->setUserId( $this->getUserId() );
        $access->setGitlabApiVersion( 'v2' );   // we'll keep API version hardcoded for now
        return $access;
    }
    
    public function authenticateAccessObject( Access $access )
    {
        $user = $this->api->getUser( $access );
        if ( is_array( $user ) )
        {
            if ( isset( $user['id'] ) ) $access->setGitlabUserId( $user['id'] );
            if ( isset( $user['name'] ) ) $access->setGitlabUserName( $user['name'] );
            return $user;
        }
        return false;
    }
    
    public function getAccessData( $accessId = null )
    {
        if ( null !== $accessId )
        {
            return $this->om->getRepository( 'WGGitlabBundle:Access' )
                            ->findOneBy( array(
                                'userId' => $this->getUserId(),
                                'id' => $accessId,
                            ));
        }
        return $this->om->getRepository( 'WGGitlabBundle:Access' )
                        ->findBy( array( 'userId' => $this->getUserId() ) );
    }
    
    public function getUserId()
    {
        if ( null === $this->userId )
        {
            $user = $this->sec->getToken()->getUser();
            if ( $user && gettype( $user ) == 'object' && method_exists( $user, 'getId' ) )
            {
                $this->userId = $user->getId();
            }
            else throw new \Exception( 'Your User object must implement getId() method.' );
        }
        return $this->userId;
    }
}
