<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\CartBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;
use Ladensia\CoreBundle\Entity\Payment;

class OrderType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $order_date = date('d.mY H:i');
        $status = 'neu';
        
        $builder
                ->add('order_date', 'hidden', array('attr' => array('value' => $order_date)))
                ->add('status', 'hidden', array('attr' => array('value' => $status)))
                ->add('amount', 'hidden', array('attr' => array('value' => '1')))
//                ->add('paymentMethod', 'hidden', array('attr' => array('value' => 'elv_buy')))
                ->add('paymentMethod', 'collection', array(
                    'type' => 'choice',
                    'options' => array(
                        'required' => false,
                        'label' => 'Zahlungsmethode',
                    ),
                ))
                ->add('paymentMethod', 'entity', array(
                    'class' => 'LadensiaCoreBundle:ExperCash',
                    'expanded' => true,
                    'multiple' => false,
                    'property' => 'description',
                ))
                ->add('returnUrl', 'hidden', array('attr' => array('value' => '/')))
                ->add('memo', 'textarea', array('label' => 'Notiz zur Bestellung'))
            
            ;
    }

    public function getName() {
        return 'payment';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\Payment',
            'id' => null
        );
    }

}
