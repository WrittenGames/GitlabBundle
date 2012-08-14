<?php

namespace WG\GitlabBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class IssueType extends AbstractType
{
    public function buildForm( FormBuilder $builder, array $options )
    {
        $builder->add( 'id', 'hidden' );
        $builder->add( 'projectId' );
        $builder->add( 'title' );
        $builder->add( 'description', 'textarea' );
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'WG\GitlabBundle\Model\Issue',
        );
    }
    
    public function getName()
    {
        return 'gitlabissue';
    }
}
