<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */


namespace Ladensia\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="package")
 */
class Package
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $tickets;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $products;
    
    /**
     * @ORM\Column(type="string", length=300)
     */
    protected $clients;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $webspace;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $traffic;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tickets
     *
     * @param string $tickets
     * @return Package
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
    
        return $this;
    }

    /**
     * Get tickets
     *
     * @return string 
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set products
     *
     * @param string $products
     * @return Package
     */
    public function setProducts($products)
    {
        $this->products = $products;
    
        return $this;
    }

    /**
     * Get products
     *
     * @return string 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set clients
     *
     * @param string $clients
     * @return Package
     */
    public function setClients($clients)
    {
        $this->clients = $clients;
    
        return $this;
    }

    /**
     * Get clients
     *
     * @return string 
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Set webspace
     *
     * @param string $webspace
     * @return Package
     */
    public function setWebspace($webspace)
    {
        $this->webspace = $webspace;
    
        return $this;
    }

    /**
     * Get webspace
     *
     * @return string 
     */
    public function getWebspace()
    {
        return $this->webspace;
    }

    /**
     * Set traffic
     *
     * @param string $traffic
     * @return Package
     */
    public function setTraffic($traffic)
    {
        $this->traffic = $traffic;
    
        return $this;
    }

    /**
     * Get traffic
     *
     * @return string 
     */
    public function getTraffic()
    {
        return $this->traffic;
    }
}