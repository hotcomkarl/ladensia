<?php  
/*  * This file is part of the Ladensia Shop System.   
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>   
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Order;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;
    
use Ladensia\CoreBundle\Entity\Order,
    Ladensia\AdminBundle\Form\Type\OrderType;

class OrderController extends Controller {

    /**
     * lists all available orders in a table
     *
     * @return Orders
     */
    public function listAction() {

        $title = 'Ladensia Webshop Bestellungen';
        $odId = '';
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Order');
        $orders = $repository->findBy(array(), array('order_date' => 'ASC'));
        $order = new Order;
        
        $form = $this->createForm(new OrderType(), $order);
        

        return $this->render('LadensiaAdminBundle:Order:index.html.twig', array(
                    'title' => $title,
                    'orders' => $orders,
                    'form' => $form->createView(),
                ));
    }
    
    public function newAction() {

        $title = 'Ladensia Webshop Bestellungen';
        $odId = '';
        
        $order = new Order;
        
        $form = $this->createForm(new OrderType(), $order);
        

        return $this->render('LadensiaAdminBundle:Order:index.html.twig', array(
                    'title' => $title,
                    'form' => $form->createView(),
                ));
    }
    
}