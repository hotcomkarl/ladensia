<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */


namespace Ladensia\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="payment")
 */
class Payment
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
    protected $provider;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $popupId;
    
    /**
     * @ORM\Column(type="string", length=300)
     */
    protected $amount;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $paymentMethod;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $returnUrl;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $errorUrl;
    

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
     * Set provider
     *
     * @param string $provider
     * @return Payment
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    
        return $this;
    }

    /**
     * Get provider
     *
     * @return string 
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set popupId
     *
     * @param string $popupId
     * @return Payment
     */
    public function setPopupId($popupId)
    {
        $this->popupId = $popupId;
    
        return $this;
    }

    /**
     * Get popupId
     *
     * @return string 
     */
    public function getPopupId()
    {
        return $this->popupId;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set paymentMethod
     *
     * @param string $paymentMethod
     * @return Payment
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    
        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return string 
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set returnUrl
     *
     * @param string $returnUrl
     * @return Payment
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    
        return $this;
    }

    /**
     * Get returnUrl
     *
     * @return string 
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * Set errorUrl
     *
     * @param string $errorUrl
     * @return Payment
     */
    public function setErrorUrl($errorUrl)
    {
        $this->errorUrl = $errorUrl;
    
        return $this;
    }

    /**
     * Get errorUrl
     *
     * @return string 
     */
    public function getErrorUrl()
    {
        return $this->errorUrl;
    }
}