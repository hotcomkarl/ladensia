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

class DefaultController extends Controller {

    public function indexAction() {
        
        $title = 'Ladensia Webshop';

        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:SupportTicket');
		
	$support_tickets = $repository->findBy(array(), array('id' => 'ASC'));
        
        $username = array();
        
        /*foreach ($support_tickets as $support_ticket) {
            
            $user_id = $support_ticket->getUserId();
            
            $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:User');
        
            $users = $repository->find($user_id);
            
            $username[] = $users->getName();
            
            
        }*/

        //var_dump($username);die();
        
        $repos = $this->getDoctrine()
			->getRepository('LadensiaUserBundle:User');
		
	$users = $repository->findBy(array(), array('id' => 'ASC'));
        
        /*
         * 
         * statistics
         * 
         */
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:SupportTicket');
        $support_tickets = $repository->findAll();
        
        $support_tickets_opend = $repository->findBy(array('status' => '0'));
        $support_tickets_opend = count($support_tickets_opend);
        $support_tickets_count = count($support_tickets);
        
        if($support_tickets_count != 0) {
            $percent = 100/$support_tickets_count*$support_tickets_opend;
            $percent = round($percent, '2');
        } else {
            $percent = 0;
        }
        
        return $this->render('LadensiaAdminBundle:Default:index.html.twig', array( 
            'title' => $title,
            'support_tickets' => $support_tickets,
            'users' => $users,
            'support_tickets_opend' => $support_tickets_opend,
            'support_tickets_count' => $support_tickets_count,
            'percent' => $percent,
            ));
    }



}
