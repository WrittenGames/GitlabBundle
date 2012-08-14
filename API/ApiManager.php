<?php

namespace WG\GitlabBundle\API;

use Symfony\Component\Security\Core\SecurityContextInterface;

use Doctrine\Common\Persistence\ObjectManager;

use WG\GitlabBundle\Client\HttpClientInterface,
    WG\GitlabBundle\Entity\Access,
    WG\GitlabBundle\API\Gitlab\APIv2;

class ApiManager
{
    protected $om;
    protected $sec;
    protected $client;
    protected $api;
    protected $userId;
    
    public function __construct( ObjectManager $om, SecurityContextInterface $sec, HttpClientInterface $client )
    {
        $this->om = $om;
        $this->sec = $sec;
        $this->client = $client;
    }
    
    /**
     * Obtain an object implementing the ApiInterface
     *
     * @param Access $access
     * @return \WG\GitlabBundle\ApiInterface
     * @throws \InvalidArgumentException 
     */
    public function getApi( Access $access )
    {
        switch ( $access->getApiType() )
        {
            ////////////
            // Gitlab //
            ////////////
            case Access::TYPE_GITLAB:
                switch ( $access->getApiVersion() )
                {
                    case 'v2': return new APIv2( $this->client, $access );
                    // case 'v3':
                    //     // not implemented yet
                    //     break;
                }
                break;
            ////////////
            // Github //
            ////////////
            case Access::TYPE_GITHUB:
                switch ( $access->getApiVersion() )
                {
                    // case 'v3':
                    //     // not implemented yet
                    //     break;
                }
                break;
        }
        throw new \InvalidArgumentException( 'Requested API version not implemented yet.' );
    }
    
    /**
     * Get credentials dataset(s)
     * 
     * Returns either a Doctrine Collection of WG\GitlabBundle\Entity\Access instances
     * or a singular WG\GitlabBundle\Entity\Access instance
     *
     * @param integer $accessId
     * @return mixed 
     */
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
    
    /**
     * Creates an instance of WG\GitlabBundle\Entity\Access and presets
     * it with the User ID obtained from the current security context
     *
     * @return \WG\GitlabBundle\Entity\Access 
     */
    public function createAccessObject()
    {
        $access = new Access();
        $access->setUserId( $this->getUserId() );
        return $access;
    }
    
    /**
     * Obtain the User ID from the current security context.
     * Your User object must implement a getId() method.
     *
     * @return integer
     * @throws \Exception 
     */
    public function getUserId()
    {
        if ( null === $this->userId )
        {
            $user = $this->sec->getToken()->getUser();
            if ( $user && gettype( $user ) == 'object' && method_exists( $user, 'getId' ) )
            {
                $this->userId = $user->getId();
            }
            else throw new \Exception( 'Your User object must implement a getId() method.' );
        }
        return $this->userId;
    }
}
