<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\Store\CheckoutBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;
use Ladensia\CoreBundle\Entity\Order;

class OrderType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $order_date = date('d.mY H:i');
        $status = 'neu';
        
        $builder
                ->add('order_date', 'hidden', array('attr' => array('value' => $order_date)))
                ->add('shipping_first_name', 'text', array('label' => 'Vorname'))
                ->add('shipping_last_name', 'text', array('label' => 'Nachname'))
                ->add('shipping_address1', 'text', array('label' => 'Straße & Hausnr.'))
                ->add('shipping_address2', 'text', array('label' => 'Zusatz'))
                ->add('shipping_phone', 'text', array('label' => 'Telefon'))
                ->add('shipping_state', 'text', array('label' => 'Bundesland'))
                ->add('shipping_city', 'text', array('label' => 'Stadt'))
                ->add('shipping_postal_code', 'text', array('label' => 'PLZ'))
            
            ;
    }

    public function getName() {
        return 'order';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\Order',
            'id' => null
        );
    }

}
