<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;


class XmlApiController extends Controller
{
    
    public function indexAction()
    {

        $xmlapi = $this->xmlApiService();
        
        var_dump($xmlapi);die();
        
        return $this->render('LadensiaCoreBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function xmlApiService()
    {
        
        $ip_address = $this->container->getParameter('ip_address');
        $username = $this->container->getParameter('username');
        $password = $this->container->getParameter('password');
        $debug_modus = $this->container->getParameter('debug_modus');

        $xmlapi = $this->get("xmlapi.service")->openConnection();

        return $xmlapi;

    }
}
