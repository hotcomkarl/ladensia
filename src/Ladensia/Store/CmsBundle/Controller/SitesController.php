<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\Store\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SitesController extends Controller
{
    
    public function indexAction()
    {
        $limit_categories = $this->container->getParameter('show_categories');
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');
        $categories = $repository->findBy(array(), array('name' => 'ASC'), $limit_categories);
        
        return $this->render('LadensiaCmsBundle:Sites:index.html.twig', 
                array(
                    'name' => $name,
                    'categories' => $categories,
                    ));
    }
    
    public function showAction($siteId)
    {
        $limit_categories = $this->container->getParameter('show_categories');
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');
        $categories = $repository->findBy(array(), array('name' => 'ASC'), $limit_categories);
        
        $repository = $this->getDoctrine()
			->getRepository('LadensiaCoreBundle:Site');
		
	$site = $repository->findBy(array('id' => $siteId));
        $title = $site['0']->getTitle();
        
        return $this->render('LadensiaStoreCmsBundle:Sites:show.html.twig', 
                array(
                    'site' => $site,
                    'title' => $title,
                    'products' => '',
                    'categories' => $categories,
                    ));
    }
}
