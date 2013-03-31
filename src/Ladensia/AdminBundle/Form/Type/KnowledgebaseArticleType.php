<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;

use Ladensia\CoreBundle\Entity\KnowledgebaseArticle;

class KnowledgebaseArticleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('category_id', 'collection', array(
                    'type' => 'choice',
                    'options' => array(
                        'required' => false,
                        'label' => 'Kategorie',
                    ),
                ))
                ->add('category_id', 'entity', array(
                    'class' => 'LadensiaCoreBundle:KnowledgebaseCategory',
                    'expanded' => false,
                    'multiple' => false,
                    'property' => 'name',
                ))
                ->add('name', 'text', array('label' => 'Artikelname'))
                ->add('description', 'textarea', array('label' => 'Details', 'required' => false))
                
            ;
    }

    public function getName() {
        return 'knowledgebase_article';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\KnowledgebaseArticle',
            'id' => null
        );
    }

}
