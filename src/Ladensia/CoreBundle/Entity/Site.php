<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */


namespace Ladensia\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="site")
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $meta_keywords;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $meta_description;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $title;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $heading;
    
    /**
     * @ORM\Column(type="string", length=100000, nullable=true)
     */
    protected $content;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $description;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $keywords;
    
    /**
     * @ORM\Column(type="string", length=5000, nullable=true)
     */
    protected $createdAt;
    
    /**
     * @ORM\Column(type="integer", length=1)
     */
    protected $active;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $menuName;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set meta_title
     *
     * @param string $metaTitle
     * @return Site
     */
    public function setMetaTitle($metaTitle)
    {
        $this->meta_title = $metaTitle;
    
        return $this;
    }

    /**
     * Get meta_title
     *
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    /**
     * Set meta_keywords
     *
     * @param string $metaKeywords
     * @return Site
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->meta_keywords = $metaKeywords;
    
        return $this;
    }

    /**
     * Get meta_keywords
     *
     * @return string 
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }

    /**
     * Set meta_description
     *
     * @param string $metaDescription
     * @return Site
     */
    public function setMetaDescription($metaDescription)
    {
        $this->meta_description = $metaDescription;
    
        return $this;
    }

    /**
     * Get meta_description
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Site
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Site
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return Site
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    
        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Site
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set heading
     *
     * @param string $heading
     * @return Site
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;
    
        return $this;
    }

    /**
     * Get heading
     *
     * @return string 
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set createdAt
     *
     * @param string $createdAt
     * @return Site
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return string 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return Site
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set menuName
     *
     * @param string $menuName
     * @return Site
     */
    public function setMenuName($menuName)
    {
        $this->menuName = $menuName;
    
        return $this;
    }

    /**
     * Get menuName
     *
     * @return string 
     */
    public function getMenuName()
    {
        return $this->menuName;
    }
}