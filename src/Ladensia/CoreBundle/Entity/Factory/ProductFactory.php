<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\CoreBundle\Entity\Factory;

use
    Symfony\Component\Validator\ExecutionContext,
    Symfony\Component\Validator\Constraints as Assert,
    Ladensia\AdminBundle\Entity\Product,
    Ladensia\AdminBundle\Entity\Category;

/**
* @Assert\Callback(methods={"isValidCustomer"})
*/
class ProductFactory
{
    /**
    * @return \Ladensia\AdminBundle\Entity\Category
    */
    public function make()
    {
        $category = new Category();
        //$order->setCustomer($this->customer);

        /*foreach ($this->items as $item) {
            $order->addItem($item);
        }*/

        return $category;
    }
    
}