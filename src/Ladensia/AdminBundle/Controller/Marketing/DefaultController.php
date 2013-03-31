<?php  
/*  * This file is part of the Ladensia Shop System.   
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>  
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Marketing;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        $title = 'Marketing';
        
        return $this->render('LadensiaAdminBundle:Marketing:index.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    ));
    }
}
