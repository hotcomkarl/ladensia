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

class DepartmentController extends Controller {
    
    function newDepartmentAction(Request $request) {
        
        $title = 'Support Abteilungen';
        $filter = 0;
        $knowledgebase = 0;
        
        $support_department = new SupportDepartment;
        
        $form = $this->createForm(new SupportDepartmentType(), $support_department);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($support_department);
                //var_dump($knowledgebase_cat);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_support'));
            }
        }
        
        return $this->render('LadensiaAdminBundle:Support:departments.html.twig', array(
                    'title' => $title,
                    'filter' => $filter,
                    'knowledgebase' => $knowledgebase,
                    'form' => $form->createView(),
                ));
    }
    
}