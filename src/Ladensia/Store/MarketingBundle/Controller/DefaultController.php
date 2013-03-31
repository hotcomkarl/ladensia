<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\Store\MarketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        $title = 'Marketing';
        
        return $this->render('LadensiaStoreMarketingBundle:Default:index.html.twig', 
                array(
                    'name' => '',
                    'title' => $title,
                    ));
    }
}
