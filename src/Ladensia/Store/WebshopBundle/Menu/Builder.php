<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\Store\WebshopBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Builder extends Controller
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Site');
        $aboutus = $repository->findBy(array('id' => '2'));
        $aboutus_active = $aboutus['0']->getActive();
        
        $agbs = $repository->findBy(array('id' => '3'));
        $agbs_active = $agbs['0']->getActive();
        
        $wd = $repository->findBy(array('id' => '4'));
        $wd_active = $wd['0']->getActive();
        
        $disclaimer = $repository->findBy(array('id' => '5'));
        $disclaimer_active = $disclaimer['0']->getActive();

        $menu = $factory->createItem('root');

        $menu->setChildrenAttribute('class', 'clearfix cat_box');
        $menu->setChildrenAttribute('id', 'main_nav');

//        $menu->addChild('Home', array('route' => 'LadensiaStoreWebshopBundle_homepage'));
        if($aboutus_active == 1) {
            $menu->addChild($aboutus['0']->getMenuName(), array('route' => 'LadensiaCmsBundle_aboutus'));
        } 
        if ($agbs_active == 1) {
            $menu->addChild($agbs['0']->getMenuName(), array('route' => 'LadensiaCmsBundle_agbs'));
        } 
        if ($wd_active == 1) {
            $menu->addChild($wd['0']->getMenuName(), array('route' => 'LadensiaCmsBundle_widerruf'));
        } 
        if ($disclaimer_active == 1) {
            $menu->addChild($disclaimer['0']->getMenuName(), array('route' => 'LadensiaCmsBundle_impressum'));
        }
        $menu->addChild('Kontakt', array('route' => 'LadensiaStoreWebshopBundle_homepage'));

        return $menu;
    }
    
    public function footer1Menu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');

        $menu->addChild('AGBs', array('route' => 'LadensiaStoreWebshopBundle_homepage'));
        $menu->addChild('Impressum', array('route' => 'LadensiaStoreWebshopBundle_homepage'));
        $menu->addChild('Widerrufsrecht', array('route' => 'LadensiaStoreWebshopBundle_homepage'));
        

        return $menu;
    }
}