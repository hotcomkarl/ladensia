<?php  
/*  * This file is part of the Ladensia Shop System.   
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>   
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Support;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;

use Ladensia\AdminBundle\Form\Type\SupportSearchType,
    Ladensia\AdminBundle\Form\Type\SupportTicketType,
    Ladensia\AdminBundle\Form\Type\KnowledgebaseCategoryType,
    Ladensia\AdminBundle\Form\Type\KnowledgebaseArticleType,
    Ladensia\AdminBundle\Form\Type\SupportDepartmentType,
    Ladensia\AdminBundle\Form\Type\NewsType,
    Ladensia\CoreBundle\Entity\SupportDepartment,
    Ladensia\CoreBundle\Entity\KnowledgebaseCategory,
    Ladensia\CoreBundle\Entity\KnowledgebaseArticle,
    Ladensia\CoreBundle\Entity\News,
    Ladensia\CoreBundle\Entity\SupportTicket;

class InfosystemController extends Controller {
    
    function listAction(Request $request) {
        
        $title = 'Infosystem';
        $filter = 0;
        $knowledgebase = 0;
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:News');
		
	$all_news = $repository->findAll();
        
        $news = new News();
        
        $form = $this->createForm(new NewsType(), $news);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($news);
                //var_dump($news);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_infosystem'));
            }
        }
        
        return $this->render('LadensiaAdminBundle:Support:infosystem.html.twig', array(
                    'title' => $title,
                    'filter' => $filter,
                    'knowledgebase' => $knowledgebase,
                    'news' => $all_news,
                    'form' => $form->createView(),
                ));
    }
    
    public function deleteAction($news_id) {
        
        $title = 'Ladensia Webshop Support';
        
        $em = $this->getDoctrine()->getEntityManager();
        $news = $em->getRepository('LadensiaCoreBundle:News')->find($news_id);

        $em->remove($news);
        $em->flush();

        return new Response('Datensatz erfolgreich gelöscht!');
        
    }
}