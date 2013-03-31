<?php  
/*  * This file is part of the Ladensia Shop System.   
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>   
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Statistic;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;
use Ladensia\CoreBundle\Entity\SupportTicket,
    Ladensia\UserBundle\Entity\User;

class StatisticController extends Controller {

    public function indexAction() {

        /*
         * 
         * support tickets - statistic
         * 
         */
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:SupportTicket');
        $support_tickets = $repository->findAll();
        $support_tickets_opend = $repository->findBy(array('status' => '0'));
        $support_tickets_opend = count($support_tickets_opend);
        $support_tickets_count = count($support_tickets);
        
        if( $support_tickets_count > 0) {
            $percent = 100/$support_tickets_count*$support_tickets_opend;
            $percent = round($percent, '2');
        } else {
            $percent = '';
        }
        
        /*
         * 
         * client - statistic
         * 
         */
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaUserBundle:User');
        $users = $repository->findBy(array('id' => '3'));
        $users = count($users);
        $point = '50';
        
        if($users > 0) {
            $users_percent = 100/$point*$users;
        } else {
            $users_percent = ''; 
        }
        
        $title = 'Ladensia Webshop - Auswertung Gesamtumsatz';

        return $this->render('LadensiaAdminBundle:Statistic:index.html.twig', array( 
            'title' => $title,
            'support_tickets_opend' => $support_tickets_opend,
            'support_tickets_count' => $support_tickets_count,
            'percent' => $percent,
            'users' => $users,
            'point' => $point, 
            'users_percent' => $users_percent,
            ));
    }
    
}
