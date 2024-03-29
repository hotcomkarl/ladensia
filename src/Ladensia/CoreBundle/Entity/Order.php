<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */


namespace Ladensia\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="client_order")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", length=100)
     */
    protected $order_date;
    
    /**
     * @ORM\Column(type="datetime", length=100, nullable=true)
     */
    protected $last_update;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $status;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $memo;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $shipping_first_name;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $shipping_last_name;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $shipping_address1;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $shipping_address2;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $shipping_phone;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $shipping_city;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $shipping_state;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $shipping_postal_code;
    
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $shipping_cost;    
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $payment_first_name;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $payment_last_name;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $payment_address1;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $payment_address2;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $payment_phone;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $payment_city;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $payment_state;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $payment_postal_code;
    
    /**
     * @ORM\Column(type="integer", length=15)
     */
    protected $payment_method;

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
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set last_update
     *
     * @param datetime $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->last_update = $lastUpdate;
    }

    /**
     * Get last_update
     *
     * @return datetime 
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set memo
     *
     * @param string $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }

    /**
     * Get memo
     *
     * @return string 
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set shipping_first_name
     *
     * @param string $shippingFirstName
     */
    public function setShippingFirstName($shippingFirstName)
    {
        $this->shipping_first_name = $shippingFirstName;
    }

    /**
     * Get shipping_first_name
     *
     * @return string 
     */
    public function getShippingFirstName()
    {
        return $this->shipping_first_name;
    }

    /**
     * Set shipping_last_name
     *
     * @param string $shippingLastName
     */
    public function setShippingLastName($shippingLastName)
    {
        $this->shipping_last_name = $shippingLastName;
    }

    /**
     * Get shipping_last_name
     *
     * @return string 
     */
    public function getShippingLastName()
    {
        return $this->shipping_last_name;
    }

    /**
     * Set shipping_address1
     *
     * @param string $shippingAddress1
     */
    public function setShippingAddress1($shippingAddress1)
    {
        $this->shipping_address1 = $shippingAddress1;
    }

    /**
     * Get shipping_address1
     *
     * @return string 
     */
    public function getShippingAddress1()
    {
        return $this->shipping_address1;
    }

    /**
     * Set shipping_address2
     *
     * @param string $shippingAddress2
     */
    public function setShippingAddress2($shippingAddress2)
    {
        $this->shipping_address2 = $shippingAddress2;
    }

    /**
     * Get shipping_address2
     *
     * @return string 
     */
    public function getShippingAddress2()
    {
        return $this->shipping_address2;
    }

    /**
     * Set shipping_phone
     *
     * @param string $shippingPhone
     */
    public function setShippingPhone($shippingPhone)
    {
        $this->shipping_phone = $shippingPhone;
    }

    /**
     * Get shipping_phone
     *
     * @return string 
     */
    public function getShippingPhone()
    {
        return $this->shipping_phone;
    }

    /**
     * Set shipping_city
     *
     * @param string $shippingCity
     */
    public function setShippingCity($shippingCity)
    {
        $this->shipping_city = $shippingCity;
    }

    /**
     * Get shipping_city
     *
     * @return string 
     */
    public function getShippingCity()
    {
        return $this->shipping_city;
    }

    /**
     * Set shipping_state
     *
     * @param string $shippingState
     */
    public function setShippingState($shippingState)
    {
        $this->shipping_state = $shippingState;
    }

    /**
     * Get shipping_state
     *
     * @return string 
     */
    public function getShippingState()
    {
        return $this->shipping_state;
    }

    /**
     * Set shipping_postal_code
     *
     * @param string $shippingPostalCode
     */
    public function setShippingPostalCode($shippingPostalCode)
    {
        $this->shipping_postal_code = $shippingPostalCode;
    }

    /**
     * Get shipping_postal_code
     *
     * @return string 
     */
    public function getShippingPostalCode()
    {
        return $this->shipping_postal_code;
    }

    /**
     * Set shipping_cost
     *
     * @param decimal $shippingCost
     */
    public function setShippingCost($shippingCost)
    {
        $this->shipping_cost = $shippingCost;
    }

    /**
     * Get shipping_cost
     *
     * @return decimal 
     */
    public function getShippingCost()
    {
        return $this->shipping_cost;
    }

    /**
     * Set payment_first_name
     *
     * @param string $paymentFirstName
     */
    public function setPaymentFirstName($paymentFirstName)
    {
        $this->payment_first_name = $paymentFirstName;
    }

    /**
     * Get payment_first_name
     *
     * @return string 
     */
    public function getPaymentFirstName()
    {
        return $this->payment_first_name;
    }

    /**
     * Set payment_last_name
     *
     * @param string $paymentLastName
     */
    public function setPaymentLastName($paymentLastName)
    {
        $this->payment_last_name = $paymentLastName;
    }

    /**
     * Get payment_last_name
     *
     * @return string 
     */
    public function getPaymentLastName()
    {
        return $this->payment_last_name;
    }

    /**
     * Set payment_address1
     *
     * @param string $paymentAddress1
     */
    public function setPaymentAddress1($paymentAddress1)
    {
        $this->payment_address1 = $paymentAddress1;
    }

    /**
     * Get payment_address1
     *
     * @return string 
     */
    public function getPaymentAddress1()
    {
        return $this->payment_address1;
    }

    /**
     * Set payment_address2
     *
     * @param string $paymentAddress2
     */
    public function setPaymentAddress2($paymentAddress2)
    {
        $this->payment_address2 = $paymentAddress2;
    }

    /**
     * Get payment_address2
     *
     * @return string 
     */
    public function getPaymentAddress2()
    {
        return $this->payment_address2;
    }

    /**
     * Set payment_phone
     *
     * @param string $paymentPhone
     */
    public function setPaymentPhone($paymentPhone)
    {
        $this->payment_phone = $paymentPhone;
    }

    /**
     * Get payment_phone
     *
     * @return string 
     */
    public function getPaymentPhone()
    {
        return $this->payment_phone;
    }

    /**
     * Set payment_city
     *
     * @param string $paymentCity
     */
    public function setPaymentCity($paymentCity)
    {
        $this->payment_city = $paymentCity;
    }

    /**
     * Get payment_city
     *
     * @return string 
     */
    public function getPaymentCity()
    {
        return $this->payment_city;
    }

    /**
     * Set payment_state
     *
     * @param string $paymentState
     */
    public function setPaymentState($paymentState)
    {
        $this->payment_state = $paymentState;
    }

    /**
     * Get payment_state
     *
     * @return string 
     */
    public function getPaymentState()
    {
        return $this->payment_state;
    }

    /**
     * Set payment_postal_code
     *
     * @param string $paymentPostalCode
     */
    public function setPaymentPostalCode($paymentPostalCode)
    {
        $this->payment_postal_code = $paymentPostalCode;
    }

    /**
     * Get payment_postal_code
     *
     * @return string 
     */
    public function getPaymentPostalCode()
    {
        return $this->payment_postal_code;
    }

    /**
     * Set payment_method
     *
     * @param integer $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->payment_method = $paymentMethod;
    }

    /**
     * Get payment_method
     *
     * @return integer 
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * Set order_date
     *
     * @param datetime $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->order_date = $orderDate;
    }

    /**
     * Get order_date
     *
     * @return datetime 
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }
}