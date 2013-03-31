<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */
namespace Ladensia\Store\ProductBundle\Entity;

class ProductAdminManager
{
    protected $dm;
    protected $optionGroupRepo;

    public function __construct(DocumentManager $dm, $optionGroupClass)
    {
        $this->dm = $dm;
        $this->optionGroupRepo = $this->dm->getRepository($optionGroupClass);
        parent::__construct($optionGroupClass);
    }

    /**
     * @inheritdoc
     */
    public function findOptionGroupsBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->optionGroupRepo->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritdoc
     */
    public function findOptionGroupsData(array $orderBy = null, $limit = null, $offset = null)
    {
        $qb = $this->dm->createQueryBuilder($this->optionGroupClass);
        $qb->hydrate(false);
        if($limit) {
            $qb->limit($limit);
        }
        if($offset) {
            $qb->skip($offset);
        }
        if($orderBy) {
            $qb->sort(key($orderBy), $orderBy);
        }

        return $qb->getQuery()
            ->execute();
    }

    /**
     * @inheritdoc
     */
    public function findOptionGroupById($id)
    {
        return $this->optionGroupRepo->find($id);
    }

    /**
     * @inheritdoc
     */
    function deleteOptionGroupById($id, $andFlush = true)
    {
        if ($group = $this->optionGroupRepo->find($id))
        {
            $this->dm->remove($group);
            if ($andFlush) {
                $this->dm->flush();
            }
        }
    }

    /**
     * @inheritdoc
     */
    function delete($object, $andFlush = true)
    {
        $this->dm->remove($object);
        if ($andFlush) {
            $this->dm->flush();
        }
    }

    /**
     * @inheritdoc
     */
    public function update($object, $andFlush = true)
    {
        $this->dm->persist($object);
        if ($andFlush) {
            $this->dm->flush();
        }
    }
}
