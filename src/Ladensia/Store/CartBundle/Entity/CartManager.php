<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */
namespace Ladensia\Store\CartBundle\Entity;

use Doctrine\ORM\EntityManager,
    Symfony\Component\DependencyInjection\Container;

use Ladensia\CoreBundle\Entity\Cart;

class CartManager
{
    protected $em;
    protected $cartEntity;
    protected $cartRepository;
    protected $container;

    public function __construct($container, $em)
    {
        $cartEntity = 'LadensiaCoreBundle:Cart';
        
        $this->em = $em;
        $this->cartEntity = $cartEntity;
        $this->cartRepository = $this->em->getRepository($cartEntity);
    }
    
    public function findById($id)
    {
        $criteria = array('id' => $id);
        $orderBy = null;
        $limit = null;
        $offset = null;

        return $this->cartRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    public function updateCart($sessionId, $productId, $quanity) {
        
        $criteria = array('productId' => $productId, 'sessionId' => $sessionId);
        $orderBy = null;
        $limit = null;
        $offset = null;
        
        $createdAt = date('d.m.Y H:i:s');
        
        $cart = new Cart;
        $product = new Cart;
        
        $product = $this->cartRepository->findBy($criteria, $orderBy, $limit, $offset);
        
        if(!empty($product)) {
            $product[0]->setQuantity($quanity); 
            
            $this->em->persist($product[0]);
            $this->em->flush();
        } else {
            $cart->setProductId($productId);
            $cart->setQuantity($quanity);  
            $cart->setSessionId($sessionId);
            $cart->setCreatedAt($createdAt);
            
            $this->em->persist($cart);
            $this->em->flush();
        }
        
        //$cart = $this->cartRepository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findBySessionId($sessionId)
    {
        $criteria = array('sessionId' => $sessionId);
        $orderBy = null;
        $limit = null;
        $offset = null;

        return $this->cartRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    public function updateProduct(ProductInterface $product, $andFlush = true)
    {
        $this->dm->persist($product);
        if ($andFlush) {
            $this->dm->flush();
        }
    }
}
