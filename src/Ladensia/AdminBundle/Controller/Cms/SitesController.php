<?php  
/*  * This file is part of the Ladensia Shop System.    
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>  
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Cms;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;

use Ladensia\CoreBundle\Entity\Site,
    Ladensia\AdminBundle\Form\Type\SiteType,
    Ladensia\CoreBundle\Entity\Entity\User;

class SitesController extends Controller {

    public function listAction() {
        
        $title = 'Ladensia Zusatzseiten';
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:Site');
		
	$sites = $repository->findAll();
        
        return $this->render('LadensiaAdminBundle:Cms\Sites:list.html.twig', array( 
            'title' => $title,
            'sites' => $sites,
            ));
    }
    
    public function addAction(Request $request) {
        
        $title = 'Ladensia Inhaltsverwaltung - Neue Seite';
        
        $site = new Site();

        $form = $this->createForm(new SiteType(), $site);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $date = date('d.m.Y H:i:s');
                $site->setCreatedAt($date);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($site);
                //var_dump($support_ticket);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_sites'));
            }
        }
        
        return $this->render('LadensiaAdminBundle:Cms\Sites:add.html.twig', array( 
            'title' => $title,
            'form'  => $form->createView(),
            ));
    }

    public function deleteAction($site_id) {
        $title = 'Ladensia Webshop Support';
        
        $em = $this->getDoctrine()->getEntityManager();
        $site = $em->getRepository('LadensiaCoreBundle:Site')->find($site_id);

        $em->remove($site);
        $em->flush();

        return new Response('Datensatz erfolgreich gelöscht!');
    }
    
    public function modifyAction(Request $request, $siteId) {
        $title = 'Seite ändern';
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $site = $em->getRepository('LadensiaCoreBundle:Site')->find($siteId);
        $form = $this->createForm(new SiteType(), $site);



        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($site);
                //var_dump($eventDate);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_sites'));
            }
        }

        return $this->render('LadensiaAdminBundle:Cms\Sites:add.html.twig', array(
                    'form' => $form->createView(),
                    'title'=> $title,
                ));
    }

}
