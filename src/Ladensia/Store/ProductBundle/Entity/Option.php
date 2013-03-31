<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */
namespace Ladensia\Store\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="option")
 */
class Option 
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
    protected $display;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $type;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $value;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $upcharge;

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
     * Set display
     *
     * @param string $display
     * @return Option
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    
        return $this;
    }

    /**
     * Get display
     *
     * @return string 
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Option
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Option
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set upcharge
     *
     * @param string $upcharge
     * @return Option
     */
    public function setUpcharge($upcharge)
    {
        $this->upcharge = $upcharge;
    
        return $this;
    }

    /**
     * Get upcharge
     *
     * @return string 
     */
    public function getUpcharge()
    {
        return $this->upcharge;
    }
}