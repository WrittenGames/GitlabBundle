<?php

namespace WG\GitlabBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilder;

use WG\GitlabBundle\Entity\Access;

class AccessType extends AbstractType
{
    public function buildForm( FormBuilder $builder, array $options )
    {
        $builder->add( 'id', 'hidden' );
        $builder->add( 'userId', 'hidden' );
        $builder->add( 'remoteUserId', 'hidden' );
        $builder->add( 'remoteUsername', 'hidden' );
        $builder->add( 'apiType', 'choice', array(
            //'choices' => array( Access::TYPE_GITLAB => 'Gitlab', Access::TYPE_GITHUB => 'Github' ),
            'choices' => array( Access::TYPE_GITLAB => 'Gitlab' ),
        ));
        $builder->add( 'apiHostProtocol', 'choice', array(
            'choices' => array( Access::HOST_PROTOCOL_HTTP => 'http', Access::HOST_PROTOCOL_HTTPS => 'https' ),
        ));
        $builder->add( 'apiHost' );
        $builder->add( 'apiVersion', 'choice', array(
            //'choices' => array( 'v2' => 'v2', 'v3' => 'v3' ),
            'choices' => array( 'v2' => 'v2' ),
        ));
        $builder->add( 'privateToken' );
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'WG\GitlabBundle\Entity\Access',
        );
    }
    
    public function getName()
    {
        return 'gitlabaccess';
    }
}
