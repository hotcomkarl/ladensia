<?php  
/*  * This file is part of the Ladensia Shop System.    
 * * (c) Patric Gutersohn <p.gutersohn@gmx.de>   
 * * For the full copyright and license information, please view the license.txt  
 * * file that was distributed with this source code.  
 */

namespace Ladensia\AdminBundle\Controller\Product;

use 
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\File\File,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\File\UploadedFile;
use
    Ladensia\CoreBundle\Entity\Product,
    Ladensia\AdminBundle\Form\Type\ProductType,
    Ladensia\CoreBundle\Entity\Category,
    Ladensia\CoreBundle\Entity\Factory\ProductFactory,
    Ladensia\AdminBundle\Form\ProductFormType;

class ProductController extends Controller {

    /**
     * lists all available products in a table
     *
     * @return Products
     */
    public function indexAction($catId) {

        $title = 'Ladensia Webshop Produkte';

        $products = new Product();
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Product');
        
        if($catId > 0) {
            
            $products = $this->get("product.manager")->findProductByCategory($catId);
            
        } else {

        $products = $repository->findAll();
        
        }
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');

        $categories = $repository->findAll();
        
//        var_dump($products);die();

        return $this->render('LadensiaAdminBundle:Product:index.html.twig', array(
                    'title' => $title,
                    'products' => $products,
                    'categories' => $categories,
                ));
    }
    
    public function addAction(Request $request) {
        
        $product = new Product();

        $form = $this->createForm(new ProductType(), $product);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $createdAt = date('d.m.Y H:i:s');
                $product->setCreatedAt($createdAt);
                
                $cat_id = $form['catId']->getData();
                $id = $cat_id->getId();
                $product->setCatId($id);
                
                $product_name = $form['name']->getData();
                $uuid = md5($product_name);
                $product->setUuid($uuid);
                
                $dir = 'uploads/';
                
                if($form['image']->getClientData()->getClientMimeType() == 'image/jpg' || $form['image']->getClientData()->getClientMimeType() == 'image/jpeg') {
                    $image = $uuid . '.jpg';
                    $type = 'jpg';
                } else if($form['image']->getClientData()->getClientMimeType() == 'image/png') {
                    $image = $uuid . '.png';
                    $type = 'png';
                } else if($form['image']->getClientData()->getClientMimeType() == 'image/gif') {
                    $image = $uuid . '.gif';
                    $type = 'gif';
                }
                
                $form['image']->getData()->move($dir, $image);
                $thumbnail = $this->get("image.service")->createThumbnail("uploads/" . $image, $uuid, $type);
                
                $product->setImage($image);
                $product->setThumbnail($image);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($product);

                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_product'));
            }
        }
        
        $title = 'Ladensia Webshop - Neues Produkt hinzufügen';
        
        return $this->render('LadensiaAdminBundle:Product:add.html.twig', array(
                    'title' => $title,  
                    'form' => $form->createView(),
                    
                ));
    }
    
    public function sortByCategoryAction($catId) {
        
        $title = 'Produkte';
        
        $repository = $this->getDoctrine()
                ->getRepository('LadensiaCoreBundle:Category');

        $categories = $repository->findAll();
        
        if($catId > 0) {
            
            $products = $this->get("product.manager")->findProductByCategory($catId);
            
        }
        
        return $this->render('LadensiaAdminBundle:Product:index.html.twig', array(
                'products'  => $products,
                'title' => $title,
                'categories' => $categories,
            ));
    }
    
    public function deleteAction($productId) {

        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('LadensiaCoreBundle:Product')->find($productId);

        $em->remove($product);
        $em->flush();

        return new Response('Datensatz erfolgreich gelöscht!');
    }

    public function modifyAction(Request $request, $productId) {
        $title = 'Produkt ändern';
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $product = $em->getRepository('LadensiaCoreBundle:Product')->find($productId);
        $form = $this->createForm(new ProductType(), $product);



        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $uuid_bevor = $product->getUuid();
                $product_name = $form['name']->getData();
                $uuid = md5($product_name);
                $product->setUuid($uuid);

                $dir = 'uploads/';

                if(!$uuid_bevor == $uuid) {
                
                    if($form['image']->getClientData()->getClientMimeType() == 'image/jpg' || $form['image']->getClientData()->getClientMimeType() == 'image/jpeg') {
                        $image = $uuid . '.jpg';
                        $type = 'jpg';
                    } else if($form['image']->getClientData()->getClientMimeType() == 'image/png') {
                        $image = $uuid . '.png';
                        $type = 'png';
                    } else if($form['image']->getClientData()->getClientMimeType() == 'image/gif') {
                        $image = $uuid . '.gif';
                        $type = 'gif';
                    }

                    $form['image']->getData()->move($dir, $image);
                    $thumbnail = $this->get("image.service")->createThumbnail("uploads/" . $image, $uuid, $type);

                    $product->setImage($image);
                    $product->setThumbnail($image);
                } else {
                    $product->setImage($uuid . '.jpg');
                }
                
                
                $em = $this->getDoctrine()->getEntityManager();
//                $product->setCatId('5');
                $catId = $product->getCatId();
                $catId = $catId->getId();
                $product->setCatId($catId);
                $em->persist($product);
                //var_dump($eventDate);die();
                $em->flush();

                return $this->redirect($this->generateUrl('LadensiaAdminBundle_product'));
            }
        }

        return $this->render('LadensiaAdminBundle:Product:modify.html.twig', array(
                    'form' => $form->createView(),
                    'title'=> $title,
                    //'event_id' => $this->event_id,
                ));
    }

}