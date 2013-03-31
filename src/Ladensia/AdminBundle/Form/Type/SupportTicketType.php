<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;

use Ladensia\CoreBundle\Entity\SupportTicket;

class SupportTicketType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('user_id', 'collection', array(
                    'type' => 'choice',
                    'options' => array(
                        'required' => false,
                        'label' => 'User',
                    ),
                ))
                ->add('user_id', 'entity', array(
                    'class' => 'LadensiaUserBundle:User',
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'username',
                ))
                ->add('title', 'text', array('label' => 'Betreff'))
                ->add('description', 'textarea', array('label' => 'Nachricht', 'required' => false, 'attr' => array('class' => 'cleditor')))
                ->add('department', 'collection', array(
                    'type' => 'choice',
                    'options' => array(
                        'required' => false,
                        'label' => 'Abteilung',
                    ),
                ))
                ->add('department', 'entity', array(
                    'class' => 'LadensiaCoreBundle:SupportDepartment',
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'name',
                ))
                ->add('priority', 'choice', array('label' => 'Priorität', 'choices'   => array('0' => 'niedrig', '1' => 'mittel', '2' => 'normal', '3' => 'hoch')))
                
            
            ;
    }

    public function getName() {
        return 'support_ticket';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\SupportTicket',
            'id' => null
        );
    }

}
