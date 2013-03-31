<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\Store\CheckoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ladensia\CoreBundle\Entity\Order,
    Ladensia\Store\CheckoutBundle\Form\Type\OrderType,
    Ladensia\CoreBundle\Entity\Payment,
    Ladensia\EcashBundle\Form\Type\PaymentType;

class DefaultController extends Controller
{
    
    public function stepOneAction()
    {
        $title = 'Ladensia Webshop - Checkout';
        $limit = 9;
        $limit_categories = $this->container->getParameter('show_categories');
        
        $session = $this->getRequest()->getSession();
        if($session->get('cart_value') == '') {
            $cart_value = $session->set('cart_value', '');
        } else {
           $cart_value = $session->get('cart_value');
        }
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');
        $categories = $repository->findBy(array(), array('name' => 'ASC'), $limit_categories);
        
        $products = '';
        
        
        return $this->render('LadensiaStoreCheckoutBundle:Checkout:step_one.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    'products' => $products,
                    'categories' => $categories,
                    'cart_value' => $cart_value,
                    'user' => '',
                    ));
        
    }
    
    public function selectPaymentAction(Request $request)
    {
        $title = 'Ladensia Webshop - Checkout';
        $limit = 9;
        $limit_categories = $this->container->getParameter('show_categories');
        
        $session = $this->getRequest()->getSession();
        if($session->get('cart_value') == '') {
            $cart_value = $session->set('cart_value', '');
        } else {
           $cart_value = $session->get('cart_value');
        }
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');
        $categories = $repository->findBy(array(), array('name' => 'ASC'), $limit_categories);
        
        $products = '';
        
        $payment = new Payment();

        $form = $this->createForm(new PaymentType(), $payment);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $paymentDetails = $form['paymentMethod']->getData();
                $paymentMethod = $paymentDetails->getPaymentMethod();
                
                $payment->setPaymentMethod($paymentMethod);
                
                $session->set('paymentMethod', $paymentMethod);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($payment);

                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaEcashBundle_payment'));
            }
        }
        
        
        return $this->render('LadensiaStoreCheckoutBundle:Checkout:select_payment.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    'products' => $products,
                    'categories' => $categories,
                    'cart_value' => $cart_value,
                    'user' => '',
                    'form' => $form->createView(),
                    ));
        
    }
    
    public function loginAction(Request $request)
    {
        $title = 'Ladensia Webshop - Checkout';
        $limit = 9;
        $limit_categories = $this->container->getParameter('show_categories');
        
        $session = $this->getRequest()->getSession();
        if($session->get('cart_value') == '') {
            $cart_value = $session->set('cart_value', '');
        } else {
           $cart_value = $session->get('cart_value');
        }
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');
        $categories = $repository->findBy(array(), array('name' => 'ASC'), $limit_categories);
        
        $products = '';
        
        $order = new Order();

        $form = $this->createForm(new OrderType(), $order);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $paymentDetails = $form['paymentMethod']->getData();
                $paymentMethod = $paymentDetails->getPaymentMethod();
                
                $payment->setPaymentMethod($paymentMethod);
                
                $session->set('paymentMethod', $paymentMethod);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($payment);

                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaEcashBundle_payment'));
            }
        }
        
        
        return $this->render('LadensiaStoreCheckoutBundle:Checkout:login.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    'products' => $products,
                    'categories' => $categories,
                    'cart_value' => $cart_value,
                    'user' => '',
                    'form' => $form->createView(),
                    ));
        
    }
}
