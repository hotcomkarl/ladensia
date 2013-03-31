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

use Ladensia\CoreBundle\Entity\Entity\SupportTicket,
    Ladensia\CoreBundle\Entity\News,
    Ladensia\AdminBundle\Form\Type\NewsType,
    Ladensia\CoreBundle\Entity\Entity\User;

class NewsController extends Controller {

    public function listAction() {
        
        $title = 'Ladensia - News';
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:News');
		
	$news = $repository->findAll();
        
        return $this->render('LadensiaAdminBundle:Cms\News:list.html.twig', array( 
            'title' => $title,
            'news'  => $news,
            ));
    }
    
    public function addAction(Request $request) {
        
        $title = 'Ladensia - Neues Posting veröffentlichen';
        
        $news = new News();

        $form = $this->createForm(new NewsType(), $news);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $date = date('d.m.Y H:i:s');
                $news->setCreatedAt($date);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($news);
//                var_dump($news);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_news'));
            }
        }
        
        return $this->render('LadensiaAdminBundle:Cms\News:add.html.twig', array( 
            'title' => $title,
            'form'  => $form->createView(),
            ));
    }
    
    public function deleteAction($posting_id) {
        
        $title = 'Ladensia - News';
        
        $em = $this->getDoctrine()->getEntityManager();
        $posting = $em->getRepository('LadensiaCoreBundle:News')->find($posting_id);

        $em->remove($posting);
        $em->flush();

        return new Response('Datensatz erfolgreich gelöscht!');
    }
    
    public function modifyAction(Request $request, $postingId) {
        
        $title = 'Ladensia - Posting ändern';
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $posting = $em->getRepository('LadensiaCoreBundle:News')->find($postingId);
        $form = $this->createForm(new NewsType(), $posting);



        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($posting);
                //var_dump($eventDate);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_news'));
            }
        }
        
        return $this->render('LadensiaAdminBundle:Cms\News:add.html.twig', array( 
            'title' => $title,
            'form' => $form->createView(),
            ));
    }



}
