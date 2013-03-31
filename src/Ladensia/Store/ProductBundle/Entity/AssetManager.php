<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */
namespace Ladensia\Store\ProductBundle\Entity;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\DependencyInjection\Container;

class AssetManager
{
    protected $dm;
    protected $assetRepo;
    protected $assetModelClass;

    public function __construct(DocumentManager $dm, $assetModelClass )
    {
        $this->dm = $dm;
        $this->assetRepo = $this->dm->getRepository($assetModelClass);
        $this->assetModelClass = $assetModelClass;

    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->assetRepo->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findAssetsByType($product, $type)
    {
        $assets = $this->assetRepo->findBy( array('type' => $type, 'product' => new \MongoId($product->getId() )));
        return $assets;
    }

    public function findAssetByType($product, $type)
    {
        $asset = $this->assetRepo->findOneBy( array('type' => $type, 'product' => new \MongoId($product->getId() )));
        return $asset;
    }

    public function updateasset(assetInterface $asset, $andFlush = true)
    {
        $this->dm->persist($asset);
        if ($andFlush) {
            $this->dm->flush();
        }
    }
}
