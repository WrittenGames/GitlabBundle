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
        // Get existing credentials
        $existingAccessData = $this->get( 'gitlab.access' )->getAccessData();
        // Process access form
        $newAccess = $this->get( 'gitlab.access' )->createAccessObject();
        $form = $this->createForm( new AccessType(), $newAccess );
        if ( null !== $request->get( 'gitlabaccess' ) )
        {
            $notYetStored = true;
            foreach ( $existingAccessData as $data )
            {
                $formValues = $request->get( 'gitlabaccess' );
                if ( $data->getGitlabToken() == $formValues['gitlabToken'] )
                {
                    $notYetStored = false;
                    break;
                }
            }
            if ( $notYetStored )
            {
                $form->bindRequest( $request );
                if ( $form->isValid() && $this->get( 'gitlab.access' )->authenticateAccessObject( $newAccess ) )
                {
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist( $newAccess );
                    $em->flush();
                    return $this->redirect( $this->generateUrl( $request->get('_route') ) );
                }
            }
        }
        // Render view
        return $this->render( 'WGGitlabBundle:Access:index.html.twig', array(
            'form' => $form->createView(),
            'accessdata' => $existingAccessData,
        ));
    }
    
    public function deleteAction( Request $request )
    {
        $em = $this->getDoctrine()->getEntityManager();
        $access = $em->getRepository( 'WGGitlabBundle:Access' )->find( $request->get( 'id' ) );
        $em->remove( $access );
        $em->flush();
        return $this->redirect( $this->generateUrl( 'wg_gitlab_access' ) );
    }
    
    public function selectAction( Request $request )
    {
        $accessData = $this->get( 'gitlab.access' )->getAccessData();
        if ( count( $accessData ) < 1 )
        {
            // TODO: replace with Access form:
            throw new AccessDeniedException( 'User does not have access to Gitlab credentials.' );
        }
        $access = null !== $request->get( 'access_id' )
                ? $this->get( 'gitlab.access' )->getAccessData( $request->get( 'access_id' ) )
                : $accessData[0];
        $projects = $this->get( 'gitlab.api' )->getProjects( $access );
        return $this->render( 'WGGitlabBundle:Access:select.html.twig', array(
            'accessData' => $accessData,
            'access' => $access,
            'projects' => $projects,
        ));
    }
}
