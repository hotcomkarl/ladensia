<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Menu;

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
         * new nav
         */
        $menu->addChild('Dashboard', array('route' => 'LadensiaAdminBundle_start'));
        $menu->addChild('Verkauf', array('route' => 'LadensiaAdminBundle_sale'));
        $menu->addChild('User', array('route' => 'LadensiaAdminBundle_user'));
        $menu->addChild('Support', array('route' => 'LadensiaAdminBundle_support'));
        $menu->addChild('Inhaltsverwaltung', array('route' => 'LadensiaAdminBundle_cms'));
        $menu->addChild('Konfiguration', array('route' => 'LadensiaAdminBundle_config'));
        $menu->addChild('Hilfe', array('route' => 'LadensiaAdminBundle_help')); //Dokumentation, Lizenz Info, Community, System Infos(verbrauchter Speicher tc.)
        
        $menu->addChild('Shop Frontend', array('route' => 'LadensiaStoreWebshopBundle_homepage'));
        

        return $menu;
    }
    
    /*
     * 
     * Dashboard (Startsite)
     * 
     * 
     */
    
     public function infoMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'info_nav');

        $menu->addChild('Checkliste - Erste Schritte', array('uri' => '/'));
        $menu->addChild('Wartung aktivieren/deaktiviern', array('uri' => '/'));
        $menu->addChild('Dokumentation', array('uri' => '/'));
        $menu->addChild('Systeminformation', array('uri' => '/'));
        $menu->addChild('Import/Export', array('uri' => '/'));
        $menu->addChild('Anfrage an Support senden', array('uri' => '/'));
        $menu->addChild('Paket upgraden', array('uri' => '/'));
        $menu->addChild('Hosting und Domains', array('uri' => '/'));

        return $menu;
    }
    
    /*
     * 
     * Verkauf (Verkaufsbereich)
     * 
     */
    
    //Produkt Kategorien
    public function catMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'cat_nav');

        $menu->addChild('Kategorien verwalten', array('route' => 'LadensiaAdminBundle_category'));

        return $menu;
    }
    
    //Produkte/Services
    public function productMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'product_nav');

        $menu->addChild('Produkte', array('uri' => '/admin/products/0/'));
        // $menu->addChild('Hersteller', array('uri' => '/')); 
        // $menu->addChild('Versand', array('uri' => '/'));
        $menu->addChild('Lagerverwaltung', array('uri' => '/'));

        return $menu;
    }
    
    //Bestellungen
    public function orderMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'order_nav');

        $menu->addChild('Bestellungen', array('route' => 'LadensiaAdminBundle_order'));
        $menu->addChild('E-Mail Benachrichtigungen', array('uri' => '/'));

        return $menu;
    }
    
    //Rechnungsverwaltung
    public function invoiceMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'invoice_nav');

        $menu->addChild('Kontoübersicht', array('uri' => '/'));
        $menu->addChild('Rechnungen', array('uri' => '/'));

        return $menu;
    }
    
    //Transaktionsverwaltung
    public function transMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'trans_nav');

        $menu->addChild('Transaktionen', array('uri' => '/'));

        return $menu;
    }
    
    //Auswertung
    public function statisticMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'statistic_nav');

        $menu->addChild('Übersicht', array('route' => 'LadensiaAdminBundle_statistic'));

        return $menu;
    }  
    
    /*
     * 
     * User (Kundenverwaltung)
     * 
     */
    
    //Produkt Kategorien
    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'cat_nav');

        $menu->addChild('Alle User anzeigen', array('route' => 'LadensiaAdminBundle_user'));
        $menu->addChild('Mitarbeiter', array('uri' => '/'));

        return $menu;
    }
    
    /*
     * 
     * Support (Kundenkontakt)
     * 
     */
    
    //Support Allgemein
    public function supportMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'cat_nav');

        $menu->addChild('Alle Tickets anzeigen', array('route' => 'LadensiaAdminBundle_support'));
        $menu->addChild('Support Abteilungen', array('route' => 'LadensiaAdminBundle_support_department'));
        $menu->addChild('Ticket öffnen', array('route' => 'LadensiaAdminBundle_open_ticket'));

        return $menu;
    }
    
    /*
     * 
     * 
     * Cms (Inhaltsverwaltung)
     * 
     */
    public function cmsMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'cms_nav');

        $menu->addChild('Layout', array('uri' => '/'));
        $menu->addChild('Zusatzseiten', array('route' => 'LadensiaAdminBundle_sites'));
        $menu->addChild('News', array('route' => 'LadensiaAdminBundle_news'));

        return $menu;
    }
    
    /*
     * 
     * Config (Konfiguration)
     * 
     */
    public function configMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'imex_nav');

        $menu->addChild('Allgemein', array('uri' => '/'));
        $menu->addChild('Mein Account', array('uri' => '/'));
        $menu->addChild('Paypal Einstellungen', array('uri' => '/'));
        $menu->addChild('Kontaktdaten', array('uri' => '/')); 
        $menu->addChild('Domains & Hosting', array('uri' => '/'));
        
        return $menu;
    }
    
    /*
     * 
     * Hilfe
     * 
     */
    public function helpMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'clearfix');
        $menu->setChildrenAttribute('id', 'imex_nav');

        $menu->addChild('FAQ', array('uri' => '/'));
        $menu->addChild('Lizenz Info', array('uri' => '/'));
        $menu->addChild('System Info', array('uri' => '/'));
        $menu->addChild('Supportanfrage', array('uri' => '/'));

        return $menu;
    }
    
    
}