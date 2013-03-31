<?php  
/*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;
use Ladensia\CoreBundle\Entity\Category;

class CategoryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('parent_id', 'hidden', array('attr' => array('value' => '0')))
                ->add('name', 'text', array('label' => 'Name', 'required' => true))
                ->add('description', 'textarea', array('label' => 'Beschreibung', 'required' => true))
                //->add('image', 'file', array('label' => 'Bild', 'required' => false))
            
            ;
    }

    public function getName() {
        return 'category';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\Category',
            'id' => null
        );
    }

}
