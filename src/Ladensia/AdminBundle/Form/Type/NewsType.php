<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;

use Ladensia\CoreBundle\Entity\News;

class NewsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
//                ->add('created_at', 'hidden', array()))
                ->add('heading', 'text', array('label' => 'Überschrift', 'required' => true))
                ->add('details', 'textarea', array('label' => 'Details', 'required' => true, 'attr' => array('class' => 'cleditor')))
            
            ;
    }

    public function getName() {
        return 'news';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\News',
            'id' => null
        );
    }

}
