<?php  
/*  * This file is part of the Ladensia Shop System.   
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>   
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Help;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;

use Ladensia\CoreBundle\Entity\Entity\SupportTicket,
    Ladensia\CoreBundle\Entity\Entity\User;

class DefaultController extends Controller {

    public function indexAction() {
        
        $title = 'Ladensia Hilfe';
        
        return $this->render('LadensiaAdminBundle:Help:index.html.twig', array( 
            'title' => $title,
            ));
    }



}
