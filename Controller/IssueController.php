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
        // Process Issue form
        $issue = new Issue();
        $form = $this->createForm( new IssueType(), $issue );
        if ( null !== $request->get( 'gitlabissue' ) )
        {
            $form->bindRequest( $request );
            if ( $form->isValid() )
            {
                $this->get( 'gitlab' )->createIssue( $issue );
                // TODO: set flash variable "issue raised etc."
                return $this->redirect( $this->generateUrl( $request->get('_route') ) );
            }
        }
        // Render view
        return $this->render( 'WGGitlabBundle:Issue:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
