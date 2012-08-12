<?php

namespace WG\GitlabBundle\Gitlab;

use Symfony\Component\Security\Core\SecurityContextInterface;

use Doctrine\Common\Persistence\ObjectManager;

use WG\GitlabBundle\Client\ClientInterface,
    WG\GitlabBundle\Entity\Access,
    WG\GitlabBundle\Model\Issue,
    WG\GitlabBundle\Model\Milestone,
    WG\GitlabBundle\Model\Project,
    WG\GitlabBundle\Model\User;

class API
{
    protected $access;
    protected $client;
    
    public function __construct( ClientInterface $client )
    {
        $this->client = $client;
    }
    
    public function setAccess( Access $access )
    {
        $this->access = $access;
    }
    
    public function getProjects( Access $access )
    {
        $projects = array();
        $data = $this->client->get( $this->access, '/projects' );
        if ( is_array( $data ) )
        {
            
        }
    }
    
    public function save( $entity )
    {
        if ( $entity instanceof Issue )
        {
            if ( null === $entity->getProjectId() )
            {
                throw new \InvalidArgumentException( 'Issue instance requires a project.' );
            }
            if ( null === $entity->getTitle() )
            {
                throw new \InvalidArgumentException( 'Issue instance requires a title.' );
            }
            $data = array();
            $url = '/projects/' . $entity->getProjectId . '/issues';
            if ( null === $entity->getId() )
            {
                $this->client->post( $url, $data );
            }
            else
            {
                $url = $url . '/' . $entity->getId();
                $this->client->put( $url, $data );
            }
        }
        else
        {
            throw new \Exception( 'Saving instance of ' . get_class( $entity ) . ' not yet implemented upstream.' );
        }
    }
    
    public function delete( $entity )
    {
        if ( $entity instanceof Issue )
        {
            $url = '/projects/' . $entity->getProjectId . '/issues/' . $entity->getId();
            $this->client->delete( $url );
        }
        else
        {
            throw new \Exception( 'Deleting instance of ' . get_class( $entity ) . ' not yet implemented upstream.' );
        }
    }
    
    public function getUser( $id = null )
    {
        $url = '/user';
        if ( null !== $id ) $url .= 's/' . $id;
    }
}
