<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\Store\WebshopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Session\Session;


class DefaultController extends Controller
{
    
    
    public function indexAction()
    {
        $title = 'Ladensia Webshop - professionell, kostenlos und flexibel';
        $limit_categories = $this->container->getParameter('show_categories');
        $limit = 8;
        
        $session = $this->getRequest()->getSession();
        if($session->get('cart_value') == '') {
            $cart_value = $session->set('cart_value', '');
        } else {
           $cart_value = $session->get('cart_value');
        }
        
        //var_dump($session->get('cart_value'));die();
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Product');
        $products = $repository->findBy(array('featured' => 1), array('createdAt' => 'DESC'), $limit);
        
        $new_products = $repository->findBy(array(), array('createdAt' => 'DESC'), '6');
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');
        $categories = $repository->findBy(array(), array('name' => 'ASC'), $limit_categories);
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:News');
		
	$news = $repository->findBy(array(), array('createdAt' => 'DESC'), '3');
        
        return $this->render('LadensiaStoreWebshopBundle:Default:index.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    'products' => $products,
                    'categories' => $categories,
                    'cart_value' => $cart_value,
                    'user' => '',
                    'newProducts' => $new_products,
                    'news' => $news,
                    ));
    }
    
}
