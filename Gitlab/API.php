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
    protected $client;
    
    public function __construct( ClientInterface $client )
    {
        $this->client = $client;
    }
    
    public function getUser( Access $access, $id = null )
    {
        $url = '/user';
        if ( null !== $id ) $url .= 's/' . $id;
        $response = $this->client->get( $access, $url );
        return $response;
    }
    
    public function getProjects( Access $access, $asArrays = false )
    {
        $projectData = $this->client->get( $access, '/projects' );
        if ( !$asArrays && is_array( $projectData ) )
        {
            $projects = array();
            foreach ( $projectData as $data )
            {
                $projects[] = Project::map( $data );
            }
            $projectData = $projects;
        }
        return $projectData;
    }
    
    public function getProject( Access $access, $projectId, $asArray = false )
    {
        $project = $this->client->get( $access, '/projects/' . $projectId );
        if ( !$asArray && is_array( $project ) )
        {
            return Project::map( $project );
        }
        return $project;
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
}
