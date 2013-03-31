<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;

use Ladensia\CoreBundle\Entity\SupportDepartment;

class SupportDepartmentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('name', 'text', array('label' => 'Betreff'))
                ->add('description', 'textarea', array('label' => 'Nachricht', 'required' => false))
                
            
            ;
    }

    public function getName() {
        return 'support_department';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\SupportDepartment',
            'id' => null
        );
    }

}
