<?php  
/*  * This file is part of the Ladensia Shop System.  
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>   
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;


class UserController extends Controller {

    /**
     * Lists all available Users
     *
     * @return Response
     */
    public function indexAction() {

        $title = 'Ladensia Webshop User';
        
        $em = $this->getDoctrine()->getEntityManager();

        $users = $em->getRepository('LadensiaUserBundle:User')->findAll(); //->findBy(array(), array('username' => 'ASC'));
        
        /*$repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:User');
        $users = $repository->findBy(array(), array('name' => 'ASC'));*/
        //var_dump($categories, $catId);die();
        //$newData = $this->get("my.common.service")->testAction('patric');
        //var_dump($newData);die();

        return $this->render('LadensiaAdminBundle:User:index.html.twig', array(
                    'title' => $title,
                    'users' => $users,
                ));
    }

}

?>
