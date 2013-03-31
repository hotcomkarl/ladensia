<?php  
/*  
 * * This file is part of the Ladensia Shop System.  
 * *  
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>  
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Category;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request,
    Ladensia\CoreBundle\Entity\Category,
    Ladensia\AdminBundle\Form\Type\CategoryType;

class CategoryController extends Controller {

    /**
     * lists all available categroies in a table
     *
     * @return Categroires
     */
    public function indexAction(Request $request) {

        $title = 'Ladensia Webshop Kategorien';
        $parent_id = '0';

        //Form
        $cat = new Category();
        
        $form = $this->createForm(new CategoryType(), $cat);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($cat);
                //var_dump($cat);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_category', array('parent_id' => '0')));
            }
        }
        
        //List Categories
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');
        $categories = $repository->findBy(array('parent_id' => $parent_id), array('name' => 'ASC'));
        $parent_categories = $repository->findBy(array('parent_id' => '0'), array('name' => 'ASC'));
        //var_dump($categories, $catId);die();
        
        //$newData = $this->get("my.common.service")->testAction('patric');
        //var_dump($newData);die();

        return $this->render('LadensiaAdminBundle:Category:index.html.twig', array(
                    'title' => $title,
                    'categories' => $categories,
                    'parent_categories' => $parent_categories,
//                    'parent_id' => $parent_id,
                    'form'   => $form->createView(),
                ));
    }

    public function deleteCategoryAction($cat_id) {

        $em = $this->getDoctrine()->getEntityManager();
        $cat = $em->getRepository('LadensiaCoreBundle:Category')->find($cat_id);

        $em->remove($cat);
        $em->flush();

        return new Response('Datensatz erfolgreich gelöscht!');
    }

    public function addAction() {
        
        $title = 'Category anlegen';
        $categories = new Category();
        
        $form = $this->createForm(new CategoryType());


        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($categories);
                //var_dump($eventDate);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_category'));
            }
        }
        
        return new Response('Datensatz erfolgreich angelegt!');
        //return $this->render('LadensiaAdminBundle:Category:add.html.twig', array(
        //            'title' => $title,              
        //        ));
    }

    public function modifyAction(Request $request, $cat_id) {
        
        $title = 'Category ändern';
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $category = $em->getRepository('LadensiaCoreBundle:Category')->find($cat_id);
        $form = $this->createForm(new CategoryType(), $category);



        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($category);
                //var_dump($eventDate);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_category'));
            }
        }

        return $this->render('LadensiaAdminBundle:Category:modify.html.twig', array(
                    'form' => $form->createView(),
                    'title'=> $title,
                    //'event_id' => $this->event_id,
                ));
    }

}
