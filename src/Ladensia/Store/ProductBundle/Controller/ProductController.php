<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\Store\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProductController extends Controller
{
    
    public function productDetailAction($product_uuid)
    {
        $title = 'Ladensia Webshop - Produkt';
        
        $session = $this->getRequest()->getSession();
        if($session->get('cart_value') == '') {
            $cart_value = $session->set('cart_value', '');
        } else {
           $cart_value = $session->get('cart_value');
        }
        
        $product = $this->get("product.manager")->findProductByUniqueId($product_uuid);
        
        $category = $this->get("category.manager")->findBy(array(), array('name' => 'ASC'), '5');

        return $this->render('LadensiaStoreProductBundle:Product:detail.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    'product' => $product,
                    'categories' => $category,
                    'cart_value' => $cart_value,
                    'user' => '',
                    ));
    }
    
    public function listAction($criteria) {
        
        $title = 'Ladensia Webshop - Produkt';
        
        $id = $criteria;
        $orderBy = array('createdAt' => 'ASC');
        $product = '';
        
        $session = $this->getRequest()->getSession();
        
        if($session->get('cart_value') == '') {
            $cart_value = $session->set('cart_value', '');
        } else {
           $cart_value = $session->get('cart_value');
        }
        
        $category = $this->get("category.manager")->findBy(array(), array('name' => 'ASC'), '5');
        
        $products = $this->get("product.manager")->findProductByCategory($id, $orderBy);
        
        return $this->render('LadensiaStoreProductBundle:Product:list.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    'product' => $product,
                    'categories' => $category,
                    'products' => $products,
                    'cart_value' => $cart_value,
                    'user' => '',
                    ));
        
        
    }
    
    public function listCategoriesAction() {
        
        $title = 'Alle Kategorien';
        
        $session = $this->getRequest()->getSession();
        
        if($session->get('cart_value') == '') {
            $cart_value = $session->set('cart_value', '');
        } else {
           $cart_value = $session->get('cart_value');
        }
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');
        $categories = $repository->findBy(array(), array('name' => 'ASC'));
        
        return $this->render('LadensiaStoreProductBundle:Category:list.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    'categories' => $categories,
                    'cart_value' => $cart_value,
                    'user' => '',
                    ));
    }
}
