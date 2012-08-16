<?php

namespace WG\GitlabBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class IssueType extends AbstractType
{
    public function buildForm( FormBuilder $builder, array $options )
    {
        $builder->add( 'access_id', 'hidden', array(
            'property_path' => false,
        ));
        $builder->add( 'id', 'hidden' );
        $builder->add( 'projectId' );
        $builder->add( 'title' );
        $builder->add( 'description', 'textarea' );
        //$builder->add( 'labels' );
        //$builder->add( 'assignee' );
        //$builder->add( 'milestone' ); // can't very well implement this yet, see https://github.com/gitlabhq/gitlabhq/issues/1244
    }
    
    public function getDefaultOptions( array $options )
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
