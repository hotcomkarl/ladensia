<?php  
/*  * This file is part of the Ladensia Shop System.   
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>    
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Sale;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends Controller {
    
    public function indexAction() {
        
        $title = 'Ladensia Webshop Verkaufsbereich';
        //$baseUrl = 'http://localhost/~patricgutersohn/webshop_sf/web';
        
        return $this->render('LadensiaAdminBundle:Sale:index.html.twig', array( 
            'title' => $title,
            //'baseUrl' => $baseUrl,
            ));
    }

}