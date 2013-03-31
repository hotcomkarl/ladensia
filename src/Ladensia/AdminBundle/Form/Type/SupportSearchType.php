<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

namespace Ladensia\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\HttpFoundation\Request,
    Doctrine\ORM\EntityRepository;

use Ladensia\CoreBundle\Entity\SupportTicket;

class SupportSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('search', 'text', array('label' => 'Suche','required' => false))
                ->add('status', 'choice', array('label' => 'Status', 'choices'   => array('none' => ' - ', 'm' => 'geöffnet', 'f' => 'geschlossen', 'e' => 'beantwortet', 'a' => 'neu')))
                ->add('priority', 'choice', array('label' => 'Priorität', 'choices'   => array('none' => ' - ','m' => 'geöffnet', 'f' => 'geschlossen', 'e' => 'beantwortet', 'a' => 'neu')))
                ->add('departure', 'choice', array('label' => 'Abteilung', 'choices'   => array('none' => ' - ','m' => 'geöffnet', 'f' => 'geschlossen', 'e' => 'beantwortet', 'a' => 'neu')))
                ->add('sort', 'choice', array('label' => 'Sortierung', 'choices'   => array('none' => ' - ','m' => 'geöffnet', 'f' => 'geschlossen', 'e' => 'beantwortet', 'a' => 'neu')))
                //->add('image', 'file', array('label' => 'Bild', 'required' => false))
            
            ;
    }

    public function getName() {
        return 'search';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ladensia\CoreBundle\Entity\SupportTicket',
            'id' => null
        );
    }

}
