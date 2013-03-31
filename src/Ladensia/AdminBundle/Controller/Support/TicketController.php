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

class TicketController extends Controller {
    
    public function deleteAction($ticket_id) {
        $title = 'Ladensia Webshop Support';
        
        $em = $this->getDoctrine()->getEntityManager();
        $support_ticket = $em->getRepository('LadensiaCoreBundle:SupportTicket')->find($ticket_id);

        $em->remove($support_ticket);
        $em->flush();

        return new Response('Datensatz erfolgreich gelöscht!');
        
    }
    
    public function openAction(Request $request) {
        
        $title = 'Ladensia Webshop Support';
        $filter = 0;
        $knowledgebase = 0;
        
        $support_ticket = new SupportTicket();
        $department = new SupportDepartment();
        
        $search_form = $this->createForm(new SupportSearchType());
        $form = $this->createForm(new SupportTicketType(), $support_ticket);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                //$userId = 1;
                $createdAt = date('d.m.Y H:i:s');
                $department = $form['department']->getData();
                $department = $department->getName();
                $em = $this->getDoctrine()->getEntityManager();
                $user = $form['user_id']->getData();
                $userId = $user->getId();
                $support_ticket->setUserId($userId);
                $support_ticket->setCreatedAt($createdAt);
                $support_ticket->setDepartment($department);
                $support_ticket->setStatus('0');
                //var_dump($userId);die();
                $em->persist($support_ticket);
                //var_dump($support_ticket);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_support'));
            }
        }
        
        return $this->render('LadensiaAdminBundle:Support:new_ticket.html.twig', array(
                    'title' => $title,
                    'search_form'   => $search_form->createView(),
                    'form'   => $form->createView(),
                    'filter' => $filter,
                    'knowledgebase' => $knowledgebase,
                    //'support_tickets' => $support_tickets,
                ));
    } 
}