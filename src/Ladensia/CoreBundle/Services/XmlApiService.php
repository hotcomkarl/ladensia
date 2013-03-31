<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

/**
 * XmlApiQueryBuilderService.php
 *
 * @category            Ladensia
 * @package             CoreBundle
 * @subpackage          Service
 */

namespace Ladensia\CoreBundle\Services;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

use Ladensia\CoreBundle\Services\library\XmlApi;


class XmlApiService
{
    
    protected $ip_adress;
    protected $username;
    protected $password;
    protected $debug_modus;    

    /**
     * Sets up the connection to teh xml api
     *
     * @param string $srcFile, $destFile, $width, $quality
     * @return Thumbnail filename on sucess or blank on fail
     */
    public function __construct() {

    }
    
    public function openConnection() {
        
        $id = '0';
        
        $this->container = new ContainerBuilder();
        $this->container->compile();
        var_dump($this->container->getParameter('ip_address'));die();
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:ApiUser');
        $api_user = $repository->findBy(array('id' => $id), array());
        
        

        $this->ip_adress = $ip_address;
        $this->username = $username;
        $this->password = $password;
        $this->debug_modus = $debug_modus;

        $xmlapi = new XmlApi($this->ip_adress);
        
        $xmlapi->password_auth($this->username, $this->password); 
        $xmlapi->set_debug($this->debug_modus);  
        
        return $xmlapi;
    }


    public function queryBuilder($user, $module, $function, $args = array()) {
     
        //$xmlapi->api1_query('accountname','SubDomain','addsubdomain',array('sub','domain.com',0,0,'/public_html/folder'));
        $xmlapi->api1_query($user, $module, $function, $args = array());
        
    }

    

}