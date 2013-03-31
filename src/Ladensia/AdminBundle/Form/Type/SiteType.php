<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;

use Ladensia\CoreBundle\Entity\Site;

class SiteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('menuName', 'text', array('label' => 'Navigation Name'))
                ->add('title', 'text', array('label' => 'Title'))
                ->add('heading', 'text', array('label' => 'Überschrift'))
                ->add('content', 'textarea', array('label' => 'Inhalt', 'required' => false, 'attr' => array('class' => 'cleditor')))
                ->add('description', 'text', array('label' => 'Kurzbeschreibung', 'required' => false))
                ->add('keywords', 'text', array('label' => 'Schlagworte', 'required' => false))
                ->add('meta_keywords', 'text', array('label' => 'Meta Keywords', 'required' => false))
                ->add('meta_description', 'text', array('label' => 'Meta Beschreibung', 'required' => false))
                ->add('active', 'choice', array('label' => 'Sichtbarkeit', 'choices' => array('0' => 'Offline', '1' => 'Online')))
                
            ;
    }

    public function getName() {
        return 'site';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\Site',
            'id' => null
        );
    }

}
