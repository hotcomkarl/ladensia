<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */


namespace Ladensia\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News
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
    protected $heading;
    
    /**
     * @ORM\Column(type="string", length=1000000)
     */
    protected $details;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $createdAt;
    

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
     * Set heading
     *
     * @param string $heading
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;
    }

    /**
     * Get heading
     *
     * @return string 
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set details
     *
     * @param string $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * Get details
     *
     * @return string 
     */
    public function getDetails()
    {
        return $this->details;
    }
    
    /**
     * Get details
     *
     * @return string 
     */
    public function getDetailsShort()
    {
        $detailsShort = substr($this->details, 0, 250);
        return $detailsShort;
    }

    /**
     * Set created_at
     *
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return string 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}