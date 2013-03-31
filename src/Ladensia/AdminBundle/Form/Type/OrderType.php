<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;

use Ladensia\CoreBundle\Entity\Category;

class OrderType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $order_date = date('d.m.Y H:i:s');
        $status = 0;

        $builder
                ->add('order_date', 'hidden', array('attr' => array('value' => $order_date)))
                ->add('status', 'hidden', array('attr' => array('value' => $status)))
                ->add('memo', 'textarea', array('label' => 'Notiz zur Bestellung'))
                
                ->add('shipping_first_name', 'text', array('label' => 'Vorname'))
                ->add('shipping_last_name', 'text', array('label' => 'Nachname'))
                ->add('shipping_address1', 'text', array('label' => 'Straße/Hnr.'))
                ->add('shipping_address2', 'text', array('label' => 'Zusatz'))
                ->add('shipping_phone', 'text', array('label' => 'Telefon'))
                ->add('shipping_city', 'text', array('label' => 'Stadt'))
                ->add('shipping_state', 'choice', array('label' => 'Land'))
                ->add('shipping_postal_code', 'text', array('label' => 'PLZ'))
                ->add('shipping_cost', 'text', array('label' => 'Versandkosten'))
                
                ->add('payment_first_name', 'text', array('label' => 'Vorname'))
                ->add('payment_last_name', 'text', array('label' => 'Nachname'))
                ->add('payment_address1', 'text', array('label' => 'Straße/Hnr.'))
                ->add('payment_address2', 'text', array('label' => 'Zusatz'))
                ->add('payment_phone', 'text', array('label' => 'Telefon'))
                ->add('payment_city', 'text', array('label' => 'Stadt'))
                ->add('payment_state', 'choice', array('label' => 'Land'))
                ->add('payment_postal_code', 'text', array('label' => 'PLZ'))
                ->add('payment_method', 'choice', array('label' => 'Zahlungsmethode'))
                
            
            ;
    }

    public function getName() {
        return 'client_order';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\Order',
            'id' => null
        );
    }

}
