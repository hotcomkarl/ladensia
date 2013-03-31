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

class DefaultController extends Controller {

    public function indexAction() {
        
        $title = 'Ladensia Webshop Support';
        $filter = 1;
        $knowledgebase = 0;
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:SupportTicket');
		
	$support_tickets = $repository->findAll();
        
        $search_form = $this->createForm(new SupportSearchType());
        
        return $this->render('LadensiaAdminBundle:Support:index.html.twig', array(
                    'title' => $title,
                    'search_form'   => $search_form->createView(),
                    'support_tickets' => $support_tickets,
                    'filter' => $filter,
                    'knowledgebase' => $knowledgebase,
                ));
        
    } 
}