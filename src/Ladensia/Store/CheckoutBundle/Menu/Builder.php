<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\Store\CheckoutBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'main_nav');
        
        /*
         * old nav
        $menu->addChild('Dashboard', array('route' => 'LadensiaAdminBundle_start'));
        $menu->addChild('Kategorien', array('route' => 'LadensiaAdminBundle_category'));
        $menu->addChild('Produkte', array('route' => 'LadensiaAdminBundle_product'));
        $menu->addChild('Bestellungen', array('route' => 'LadensiaAdminBundle_order'));
        $menu->addChild('User', array('route' => 'LadensiaAdminBundle_user'));
        $menu->addChild('Support', array('uri' => '/'));
        $menu->addChild('Konfiguration', array('uri' => '/'));
        $menu->addChild('>Shop Frontend', array('route' => 'LadensiaStoreWebshopBundle_homepage'));
         * 
         */
        
        /*
         * new naw
         */
        $menu->addChild('Dashboard', array('route' => 'LadensiaAdminBundle_start'));
        $menu->addChild('Verkauf', array('route' => 'LadensiaAdminBundle_sale'));
        $menu->addChild('User', array('route' => 'LadensiaAdminBundle_user'));
        $menu->addChild('Support', array('route' => 'LadensiaAdminBundle_support'));
        $menu->addChild('Marketing', array('route' => 'LadensiaStoreMarketingBundle_homepage'));
        $menu->addChild('Inhaltsverwaltung', array('uri' => '/'));
        $menu->addChild('Konfiguration', array('uri' => '/'));
        
        $menu->addChild('Shop Frontend', array('route' => 'LadensiaStoreWebshopBundle_homepage'));
        

        return $menu;
    }
    
    /*
     * 
     * Piwik (Werbebereich)
     * 
     */
    
    //Statistik Allgemein
    public function analyseMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'anaylse_nav');

        $menu->addChild('Dashboard', array('uri' => '/'));
        $menu->addChild('Besucher', array('uri' => '/'));
        $menu->addChild('Aktionen', array('uri' => '/'));
        $menu->addChild('Verweise', array('uri' => '/')); 
        $menu->addChild('Ziele', array('uri' => '/'));

        return $menu;
    }

}