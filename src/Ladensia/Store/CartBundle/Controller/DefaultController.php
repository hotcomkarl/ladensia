<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\Store\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ladensia\CoreBundle\Entity\Product;
use Ladensia\CoreBundle\Entity\Cart;

class DefaultController extends Controller
{
    
    public function indexAction()
    {
        $title = 'Marketing';
        
        return $this->render('LadensiaStoreMarketingBundle:Default:index.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    ));
    }
    
    public function addToCartAction($productId, $sessionId = NULL)
    {
        $title = 'Warenkorb';
        $productIds = array();
        
        $product = new Product;
        $products = array();
        $cart = new Cart;
        $price = '';
        $quantity = 2;
        
        $session = $this->getRequest()->getSession();
        $cart_value = $session->get('cart_value');
        $sessionId = $session->getId();

        if($productId != 0) {
            $product = $this->get("product.manager")->findProductById($productId);

            $cart = $this->get("cart.manager")->updateCart($sessionId, $productId, $quantity);
        }
        
        $cart_exits = $this->get("cart.manager")->findBySessionId($sessionId);
        
        if(!empty($cart_exits)) {
            foreach ($cart_exits as $value) {
                $productIds[] = $value->getProductId();
            } 

            foreach($productIds as $value) {
                $products[] = $this->get("product.manager")->findProductById($value);
            }
        }

        $prevUrl = $this->getRequest()->headers->get('referer');

        if($productId != 0) {
            if($price != '') {
                $price = $price + $product[0]->getPrice();
            } else {
                $price = $product[0]->getPrice();
            }
        }
        
        $cart_value = $session->set('cart_value', $price);
        
        $category = $this->get("category.manager")->findBy(array(), array('name' => 'ASC'), '5');
        
        $session = $this->getRequest()->getSession();
        $session;
        
        return $this->render('LadensiaStoreCartBundle:Default:cart.html.twig', 
                array(
                    'title' => $title,
                    'cart_value' => $cart_value,
                    'categories' => $category,
                    'products' => $products,
                    'user' => '',
                    'prevUrl' => $prevUrl,
                    ));

//        return new RedirectResponse($this->container->get('router')->generate('vespolina_cart_show', array('cartId' => $cartId)));
    }
}
