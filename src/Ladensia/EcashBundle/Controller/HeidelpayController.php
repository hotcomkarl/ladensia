<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\EcashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HeidelpayController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('LadensiaEcashBundle:Heidelpay:index.html.twig', array('name' => $name));
    }
}
