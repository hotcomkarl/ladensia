<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */
namespace Ladensia\Store\ProductBundle\Entity;

use Doctrine\ORM\EntityManager,
    Symfony\Component\DependencyInjection\Container;


class ProductManager
{
    protected $em;
    protected $productEntity;
    protected $productRepository;
    protected $container;

    public function __construct($container, $em)
    {
        $productEntity = 'LadensiaCoreBundle:Product';
        
        $this->em = $em;
        $this->productEntity = $productEntity;
        $this->productRepository = $this->em->getRepository($productEntity);
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->productRepository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findProductById($id)
    {
        $limit = 1;
        
        return $this->productRepository->findBy(array('id' => $id), array('createdAt' => 'DESC'), $limit);
    }
    
    public function findProductByUniqueId($uuid)
    {
        $limit = 1;
        if(ctype_alnum($uuid)) {
            return $this->productRepository->findBy(array('uuid' => $uuid), array('createdAt' => 'DESC'), $limit);
        }
    }
    
    public function getProductPrice($id)
    {
        $limit = 1;
        
        if(ctype_alnum($id)) {
            return $this->productRepository->findBy(array('id' => $id), array('createdAt' => 'DESC'), $limit);
        }
    }
    
    public function findProductByCategory($catId, $orderBy = null, $limit = null, $offset = null)
    {
        return $this->productRepository->findBy(array('catId' => $catId), $orderBy, $limit, $offset);
    }

    public function findProductByIdentifier($name, $code)
    {

    }

    public function findProductByName($name)
    {
        $products = array();
        if (!$results = $this->productRepo->findBy(array('name' => $name))) {

            return null;
        }

        $rp = new \ReflectionProperty($this->productClass, 'identifierSetClass');
        $rp->setAccessible(true);

        foreach ($results as $product) {
            $rp->setValue($product, $this->identifierSetClass);
        }

        if ($results->count() === 1) {
            $results->reset();
            return $results->getNext();
        }

        return $results;
    }

    public function findProductBySlug($slug)
    {
        if ($product = $this->productRepo->findOneBy(array('slug' => $slug))) {

            $rp = new \ReflectionProperty($product, 'identifierSetClass');
            $rp->setAccessible(true);
            $rp->setValue($product, $this->identifierSetClass);

            return $product;
        }

        return null;
    }

    public function updateProduct(ProductInterface $product, $andFlush = true)
    {
        $this->dm->persist($product);
        if ($andFlush) {
            $this->dm->flush();
        }
    }
}
