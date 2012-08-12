<?php

namespace WG\GitlabBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AccessType extends AbstractType
{
    public function buildForm( FormBuilder $builder, array $options )
    {
        $builder->add( 'id', 'hidden' );
        $builder->add( 'userId', 'hidden' );
        $builder->add( 'gitlabUserId', 'hidden' );
        $builder->add( 'gitlabUserName', 'hidden' );
        $builder->add( 'gitlabApiVersion', 'hidden' );
        $builder->add( 'gitlabHost' );
        $builder->add( 'gitlabToken' );
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
