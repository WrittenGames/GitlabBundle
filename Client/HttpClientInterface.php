<?php

/**
 * This interface serves to make sure that whatever HTTP client is used
 * nothing in the bundle will need changing as it's only using the five
 * methods below.
 * 
 * The bundle comes with an implementation of this interface that uses
 * the Buzz client, adding a dependency - in future I'll likely change
 * that to use the Symfony BrowserKit.
 */

namespace WG\GitlabBundle\Client;

use WG\GitlabBundle\Client\HttpResponse;

interface HttpClientInterface
{
    /**
     * Used for retrieving resources.
     * 
     * @param string $url
     * @return \WG\GitlabBundle\Client\HttpResponse
     */
    public function get( $url );
    
    /**
     * Used for creating resources, or performing
     * custom actions (such as merging a pull request).
     * 
     * @param string $url
     * @param string $jsonData
     * @return \WG\GitlabBundle\Client\HttpResponse
     */
    public function post( $url, $jsonData = ''  );
    
    /**
     * Used for updating resources with partial JSON data.
     * For instance, an Issue resource has title and body
     * attributes. A PATCH request may accept one or more
     * of the attributes to update the resource. PATCH is
     * a relatively new and uncommon HTTP verb, so resource
     * endpoints also accept POST requests.
     * 
     * @param string $url
     * @param string $jsonData
     * @return \WG\GitlabBundle\Client\HttpResponse
     */
    public function patch( $url, $jsonData = ''  );
    
    /**
     * Used for replacing resources or collections.
     * For PUT requests with no body attribute, be
     * sure to set the Content-Length header to zero.
     * 
     * @param string $url
     * @param string $jsonData
     * @return \WG\GitlabBundle\Client\HttpResponse
     */
    public function put( $url, $jsonData = ''  );
    
    /**
     * Used for deleting resources.
     * 
     * @param string $url
     * @return \WG\GitlabBundle\Client\HttpResponse
     */
    public function delete( $url );
}
