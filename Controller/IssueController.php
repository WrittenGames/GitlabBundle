<?php

namespace WG\GitlabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request;

use WG\GitlabBundle\Model\Issue,
    WG\GitlabBundle\Form\Type\IssueType;

class IssueController extends Controller
{
    public function indexAction( Request $request )
    {
        $formView = false;
        // List current issues (refactor this...)
        $issues = array();
        $projects = array();
        $accessData = $this->get( 'gitlab.access' )->getAccessData();
        if ( count( $accessData ) > 0 )
        {
            $access = $accessData[0];
            foreach ( $accessData as $data )
            {
                if ( $data->getId() == $request->get( 'access_id' ) )
                {
                    $access = $data;
                    break;
                }
            }
            $projects = $this->get( 'gitlab.api' )->getProjects( $access );
            if ( count( $projects ) > 0 )
            {
                $project = $projects[0];
                if ( $request->get( 'project_id' ) )
                {
                    foreach ( $projects as $data )
                    {
                        if ( $data->getId() == $request->get( 'project_id' ) )
                        {
                            $project = $data;
                            break;
                        }
                    }
                }
                $issues = $this->get( 'gitlab.api' )->getIssues( $access );
                //////////////////////////////////////////////////
                // User is associated with at least one project //
                //////////////////////////////////////////////////
                // Process Issue form
                $issue = new Issue();
                $form = $this->createForm( new IssueType(), $issue );
                if ( null !== $request->get( 'gitlabissue' ) )
                {
                    $form->bindRequest( $request );
                    if ( $form->isValid() )
                    {
                        $data = $form->getData();
                        $gitlab = $this->get( 'gitlab.api' );
                        $gitlab->save( $issue );
                        // TODO: set flash variable "issue raised etc."
                        return $this->redirect( $this->generateUrl( $request->get('_route') ) );
                    }
                }
                $formView = $form->createView();
            }
        }
        // Render view
        return $this->render( 'WGGitlabBundle:Issue:index.html.twig', array(
            'form' => $formView,
            'issues' => $issues,
            'projects' => $projects,
            'accessData' => $accessData,
        ));
    }
}
