<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\EcashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ladensia\CoreBundle\Entity\Payment,
    Ladensia\EcashBundle\Form\Type\PaymentType;


class ExpercashController extends Controller
{
    
    public function indexAction()  //$popupId, $amount, $paymentMethod, $returnUrl, $errorUrl
    {
        $title = 'Expercash Payment';
        
        $limit_categories = $this->container->getParameter('show_categories');
        
        $session = $this->getRequest()->getSession();
        
        //Expercash Parameter
        $popupId = '4712';
        $amount = '2300';
        $paymentMethod = $session->get('paymentMethod'); //'elv_buy';
        $returnUrl = 'http://ladensia.local.de/';
        $errorUrl = 'http://ladensia.local.de/';
        //https verwenden
        $cssUrl = 'http://ladensia.local.de/bundles/ladensiastorewebshop/css/style.css';
        $profile = '1';
        $currency = 'EUR';
        //own reference for transaction
        $jobId = 'test123';
        //Invoice- or Ordernumber
        $transactionId = 'testbestellung123';
        //Clientnumber
        $functionId = '123456789';
        $language = 'de';
        
        //prüfsumme zur Validierung
        $securityKey = 'TEST1234';
        
        $vars = array($popupId, $jobId, $functionId, $transactionId, $amount, $currency, $paymentMethod, $returnUrl, $errorUrl, $profile);
        
        $popupKey = md5(implode('', $vars) . $securityKey) ;
        

        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');
        $categories = $repository->findBy(array(), array('name' => 'ASC'), $limit_categories);
        
        $session = $this->getRequest()->getSession();
        if($session->get('cart_value') == '') {
            $cart_value = $session->set('cart_value', '');
        } else {
           $cart_value = $session->get('cart_value');
        }
        
//        var_dump($popupKey);die();
        
        return $this->render('LadensiaEcashBundle:Expercash:index.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    'categories' => $categories,
                    'user' => '',
                    'cart_value' => $cart_value,
                    'popupId' => $popupId,
                    'amount' => $amount,
                    'paymentMethod' => $paymentMethod,
                    'returnUrl' => $returnUrl,
                    'errorUrl' => $errorUrl,
                    'cssUrl' => $cssUrl,
                    'profile' => $profile,
                    'currency' => $currency,
                    'jobId' => $jobId,
                    'transactionId' => $transactionId,
                    'language' => $language,
                    'popupKey' => $popupKey,
                    'functionId' => $functionId,
                    ));
    }
}
