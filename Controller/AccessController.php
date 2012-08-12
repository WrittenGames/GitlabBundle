<?php

namespace WG\GitlabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request;

use WG\GitlabBundle\Entity\Access,
    WG\GitlabBundle\Form\Type\AccessType;

class AccessController extends Controller
{
    public function indexAction( Request $request )
    {
        // Process access form
        $access = new Access();
        $form = $this->createForm( new AccessType(), $access );
        if ( null !== $request->get( 'gitlabaccess' ) )
        {
            $form->bindRequest( $request );
            if ( $form->isValid() && $this->get( 'gitlab.access' )->authenticate( $access ) )
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist( $access );
                $em->flush();
                return $this->redirect( $this->generateUrl( $request->get('_route') ) );
            }
        }
        // Get existing credentials
        $existingAccessData = $this->get( 'gitlab.access' )->getAccessData();
        // Render view
        return $this->render( 'WGGitlabBundle:Access:index.html.twig', array(
            'form' => $form->createView(),
            'accessdata' => $existingAccessData,
        ));
    }
}
