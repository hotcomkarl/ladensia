<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */
namespace Ladensia\Store\ProductBundle\Entity;

use Doctrine\ORM\EntityManager,
    Symfony\Component\DependencyInjection\Container;


class CategoryManager
{
    protected $em;
    protected $categoryEntity;
    protected $categoryRepository;
    protected $container;

    public function __construct($container, $em)
    {
        $categoryEntity = 'LadensiaCoreBundle:Category';
        
        $this->em = $em;
        $this->categoryEntity = $categoryEntity;
        $this->categoryRepository = $this->em->getRepository($categoryEntity);
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->categoryRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    public function findAll() {
        return $this->categoryRepository->findAll();
    }

    public function findCategoryById($id)
    {
        $limit = 1;
        
        if(ctype_alnum($id)) {
            return $this->categoryRepository->findBy(array('uuid' => $id), array('createdAt' => 'DESC'), $limit);
        }
    }
}
