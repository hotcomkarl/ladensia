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

class KnowledgebaseController extends Controller {
    
    function categoryListAction() {
        
        $title = 'Ladensia Knowledgebase';
        $filter = 0;
        $knowledgebase = 1;
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:KnowledgebaseCategory');
		
	$knowledgebase_categories = $repository->findAll();

        
        return $this->render('LadensiaAdminBundle:Support:knowledgebase.html.twig', array(
                    'title' => $title,
                    'filter' => $filter,
                    'knowledgebase' => $knowledgebase,
                    'knowledgebase_categories' => $knowledgebase_categories,
                ));
    }
    
    function newArticleAction(Request $request) {
        
        $title = 'Ladensia Knowledgebase - Neuen Artikel hinzufügen';
        $filter = 0;
        $knowledgebase = 1;
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:KnowledgebaseCategory');
		
	$knowledgebase_categories = $repository->findAll();
        
        $knowledgebase_articles = new KnowledgebaseArticle();
        
        $form = $this->createForm(new KnowledgebaseArticleType(), $knowledgebase_articles);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $category_id = $form['category_id']->getData();
                $categoryId = $knowledgebase_articles->getCategoryId()->getId();
                $knowledgebase_articles->setCategoryId($categoryId);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($knowledgebase_articles);
                //var_dump($knowledgebase_articles);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_knowledgebase'));
            }
        }
        
        return $this->render('LadensiaAdminBundle:Support:knowledgebase_article.html.twig', array(
                    'title' => $title,
                    'filter' => $filter,
                    'knowledgebase' => $knowledgebase,
                    'knowledgebase_categories' => $knowledgebase_categories,
                    'form' => $form->createView(),
                ));
        
    }
    
    public function articleListAction($knowledgebase_category_id) {
        
        $title = 'Ladensia Webshop Support';
        $filter = 0;
        $knowledgebase = 1;
        
        $repos = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:KnowledgebaseCategory');
		
	$knowledgebase_categories = $repos->findAll();
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:KnowledgebaseArticle');
		
	$knowledgebase_articles = $repository->findBy(array('category_id' => $knowledgebase_category_id));
       
        $search_form = $this->createForm(new SupportSearchType());
        
        return $this->render('LadensiaAdminBundle:Support:knowledgebase_article_list.html.twig', array(
                    'title' => $title,
                    'search_form'   => $search_form->createView(),
                    'filter' => $filter,
                    'knowledgebase' => $knowledgebase,
                    'knowledgebase_categories' => $knowledgebase_categories,
                    'knowledgebase_articles' => $knowledgebase_articles,
                ));
        
    }
    
    function newCategoryAction(Request $request) {
        
        $title = 'Ladensia Knowledgebase - Neue Kategorie hinzufügen';
        $filter = 0;
        $knowledgebase = 1;
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:KnowledgebaseCategory');
		
	$knowledgebase_categories = $repository->findAll();
        
        $knowledgebase_cat = new KnowledgebaseCategory();
        
        $form = $this->createForm(new KnowledgebaseCategoryType(), $knowledgebase_cat);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($knowledgebase_cat);
                //var_dump($knowledgebase_cat);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_knowledgebase'));
            }
        }
        
        return $this->render('LadensiaAdminBundle:Support:knowledgebase_category.html.twig', array(
                    'title' => $title,
                    'filter' => $filter,
                    'knowledgebase' => $knowledgebase,
                    'knowledgebase_categories' => $knowledgebase_categories,
                    'form' => $form->createView(),
                ));
        
    }
}