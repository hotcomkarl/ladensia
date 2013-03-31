<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;

use Ladensia\CoreBundle\Entity\Product;

class ProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('catId', 'collection', array(
                    'type' => 'choice',
                    'options' => array(
                        'required' => false,
                        'label' => 'Kategorie',
                    ),
                ))
                ->add('catId', 'entity', array(
                    'class' => 'LadensiaCoreBundle:Category',
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'name',
                ))
                ->add('name', 'text', array('label' => 'Name'))
                ->add('price', 'text', array('label' => 'Preis'))
                ->add('description', 'textarea', array('label' => 'Beschreibung', 'max_length' => '330', 'attr' => array('required' => 'required', 'class' => 'cleditor', 'maxlength' => '10')))
                ->add('quantity', 'text', array('label' => 'Anzahl (auf Lager)'))
                ->add('image', 'file', array('label' => 'Produktbild', 'required' => false))
                ->add('featured', 'checkbox', array('label' => 'Produkt Empfehlungen (Startseite)', 'required' => false))
//                ->add('createdAt', 'hidden', array('attr' => array('value' => $date)))
                ->add('createdAt', 'hidden', array())
            ;
    }

    public function getName() {
        return 'product';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\Product',
            'id' => null
        );
    }

}
