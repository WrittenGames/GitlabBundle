<?php

namespace WG\GitlabBundle\API\Gitlab;

use Symfony\Component\Security\Core\SecurityContextInterface,
    Symfony\Component\HttpKernel\Exception\HttpException;

use Doctrine\Common\Persistence\ObjectManager;

use WG\GitlabBundle\API\ApiInterface,
    WG\GitlabBundle\Client\HttpClientInterface,
    WG\GitlabBundle\Entity\Access,
    WG\GitlabBundle\Model\Issue;

class APIv2 implements ApiInterface
{
    protected $client;
    protected $access;
    
    /**
     * @param \WG\GitlabBundle\Client\HttpClientInterface $client
     * @param \WG\GitlabBundle\Entity\Access $access 
     */
    public function __construct( HttpClientInterface $client, Access $access )
    {
        $this->client = $client;
        $this->access = $access;
    }
    
    /**
     * @param string $httpMethod
     * @param string $url
     * @param array $data
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException 
     */
    protected function call( $httpMethod, $url, array $data = array() )
    {
        ////////////////////////
        // Prepare parameters //
        ////////////////////////
        $implementedHttpMethods = array( 'get', 'post', 'patch', 'put', 'delete' );
        $benignStatusCodes = array( 200, 201, 204 );
        if ( !in_array( $httpMethod, $implementedHttpMethods ) )
        {
            throw new \InvalidArgumentException( 'Requested HTTP method unknown.' );
        }
        $url = $this->prepareUrl( $url );
        $jsonData = count( $data ) > 0 ? json_encode( $data, true ) : '';
        ////////////////////////////////////////
        // Make the request to the API server //
        ////////////////////////////////////////
        $httpResponse = $this->client->$httpMethod( $url, $jsonData );
        ////////////////////////////
        // Deal with the response //
        ////////////////////////////
        $statusCode = $httpResponse->getStatusCode();
        if ( !in_array( $statusCode, $benignStatusCodes ) )
        {
            throw new HttpException( 'API Server returned status code ' . $statusCode );
        }
        return json_decode( $httpResponse->getBody(), true );
    }
    
    /**
     * @param string $url
     * @return string
     * @throws \InvalidArgumentException  
     */
    public function prepareUrl( $url )
    {
        if ( !is_string( $url ) )
        {
            throw new \InvalidArgumentException( 'URL parameter must be of type string!' );
        }
        $version = $this->access->getApiVersion();
        $token = $this->access->getPrivateToken();
        $host = $this->access->getApiHost();
        $protocol = $this->access->getApiHostProtocol() == Access::HOST_PROTOCOL_HTTP
                    ? 'http' : 'https';
        return $protocol . '://' . $host . '/api/' . $version . $url . '?private_token=' . $token;
    }

    /**
     * @return \WG\GitlabBundle\Entity\Access
     */
    public function authenticate()
    {
        try
        {
            $user = $this->getUser();
        }
        catch( HttpException $e )
        {
            return null;
        }
        $this->access->setRemoteUserId( $user['id'] );
        $this->access->setRemoteUsername( $user['name'] );
        return $this->access;
    }
    
    /**
     * @param integer $userId
     * @return array
     * @throws \InvalidArgumentException 
     */
    public function getUser( $userId = null )
    {
        $url = '/user';
        if ( null !== $userId )
        {
            if ( !is_integer( $userId ) )
            {
                throw new \InvalidArgumentException( 'User ID parameter must be of type integer!' );
            }
            $url .= 's/' . $userId;
        }
        return $this->call( 'get', $url );
    }
    
    /**
     * @return array 
     */
    public function getProjects()
    {
        return $this->call( 'get', '/projects' );
    }
    
    /**
     * @param mixed $projectId
     * @return array
     * @throws \InvalidArgumentException 
     */
    public function getProject( $projectId )
    {
        if ( null === $projectId ) throw new \InvalidArgumentException( 'Project ID parameter is not optional!' );
        return $this->call( 'get', '/projects/' . $projectId );
    }

    /**
     * @param Issue $issue
     * @return boolean
     * @throws \InvalidArgumentException 
     */
    public function createIssue( Issue $issue )
    {
        if ( null === $issue->getTitle() ) throw new \InvalidArgumentException( 'Issue must have a title!' );
        if ( null === $issue->getProjectId() ) throw new \InvalidArgumentException( 'Issue must have a project ID!' );
        $url = '/projects/' . $issue->getProjectId() . '/issues';
        $data = array(
            'id' => $issue->getProjectId(),
            'title' => $issue->getTitle(),
        );
        if ( null !== $issue->getDescription() ) $data['description'] = $issue->getDescription();
        try
        {
            $this->call( 'post', $url, $data );
        }
        catch( HttpException $e )
        {
            return false;
        }
        return true;
    }
    
    /**
     * @param mixed $projectId
     * @param integer $issueId
     * @return boolean
     */
    public function deleteIssue( $projectId, $issueId )
    {
        throw new \Exception( 'Method not implemented yet.' );
        if ( null === $issueId ) throw new \InvalidArgumentException( 'Need an issue ID to delete issue!' );
        if ( null === $projectId ) throw new \InvalidArgumentException( 'Need a project ID to delete issue!' );
        $url = '/projects/' . $projectId . '/issues/' . $issueId;
        try
        {
            $this->call( 'delete', $url );
        }
        catch( HttpException $e )
        {
            return false;
        }
        return true;
    }

    /**
     * @param mixed $projectId
     * @return array
     * @throws \InvalidArgumentException 
     */
    public function getIssues( $projectId = null )
    {
        throw new \Exception( 'Method not implemented yet.' );
        // TODO
    }

    /**
     * @param mixed $projectId
     * @param integer $issueId
     * @return array
     * @throws \InvalidArgumentException 
     */
    public function getIssue( $projectId, $issueId )
    {
        throw new \Exception( 'Method not implemented yet.' );
        // TODO
    }

    /**
     * @param Issue $issue
     * @return boolean
     * @throws \InvalidArgumentException 
     */
    public function editIssue( Issue $issue )
    {
        throw new \Exception( 'Method not implemented yet.' );
        // TODO
    }
}
