<?php

/**
 * Set your private API token in an application config file:
 * 
 * wg_gitlab:
 *     private_token:   myPrivateToken
 */

namespace WG\GitlabBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\Config\FileLocator,
    Symfony\Component\DependencyInjection\Loader\YamlFileLoader,
    Symfony\Component\DependencyInjection\ContainerBuilder;

class WGGitlabExtension
{
    public function load( array $configs, ContainerBuilder $container )
    {
        // Merge data from configuration files, extending files override
        $config = array();
        foreach ( $configs as $subConfig ) $config = array_merge( $config, $subConfig );
        // Load bundle default configuration
        $loader = new YamlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) );
        $loader->load( 'services.yml' );
        // Set parameters
        if ( !isset( $config['private_token'] ) )
        {
            throw new \InvalidArgumentException( 'The "private_token" option must be set in your config files.' );
        }
        $container->setParameter( 'wg_gitlab.api.private_token', $config['private_token'] );
    }
}
