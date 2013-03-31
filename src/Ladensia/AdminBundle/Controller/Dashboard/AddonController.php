<?php  
/*  * This file is part of the Ladensia Shop System.   
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>   
 * * For the full copyright and license information, please view the license.txt 
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;
use Ladensia\CoreBundle\Entity\Entity\SupportTicket,
    Ladensia\CoreBundle\Entity\Entity\User;

class AddonController extends Controller {

    public function indexAction() {
        
        $title = 'Ladensia Linkliste erweitern';
        
        return $this->render('LadensiaAdminBundle:Default:index.html.twig', array( 
            'title' => $title,
            ));
    }
    
    public function addLinkAction() {
        
        $title = 'Ladensia Linkliste erweitern';
        
        
        
        return $this->render('LadensiaAdminBundle:Default:add_link.html.twig', array( 
            'title' => $title,
            ));
    }



}
