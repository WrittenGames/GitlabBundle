<?php

namespace WG\GitlabBundle\Gitlab;

use Symfony\Component\Security\Core\SecurityContextInterface;

use Doctrine\Common\Persistence\ObjectManager;

use WG\GitlabBundle\Client\ClientInterface,
    WG\GitlabBundle\Entity\Access;

class AccessManager
{
    protected $userId;
    protected $om;
    protected $client;
    
    public function __construct( ClientInterface $client, SecurityContextInterface $sc, ObjectManager $om )
    {
        $user = $securityContext->getToken()->getUser();
        if ( $user && gettype( $user ) == 'object' && method_exists( $user, 'getId' ) )
        {
            $this->userId = $user->getId();
        }
        $this->om = $om;
        $this->client = $client;
    }
    
    public function getAccessData()
    {
        if ( !$this->userId ) return array();
        return $this->om->getRepository( 'WGGitlabBundle:Access' )
                        ->findBy( array( 'userId' => $this->userId ) );
    }
    
    public function authenticate( Access $access )
    {
        if ( $this->userId )
        {
            $user = $this->client->get( $access, '/user' );
            if ( is_array( $user ) )
            {
                if ( isset( $user['id'] ) ) $access->setGitlabUserId( $user['id'] );
                if ( isset( $user['name'] ) ) $access->setGitlabUserName( $user['name'] );
                return $user;
            }
        }
        return false;
    }
}
