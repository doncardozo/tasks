<?php

namespace TC\TasksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tasks
 *
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass="TC\TasksBundle\Entity\Repository\TasksRepository")
 */
class Tasks
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var \TC\TasksBundle\Entity\Tags
     * @ORM\OneToMany(targetEntity="Tags", mappedBy="task_id", cascade={"persist"})
     */
    private $tags;
    
    
    public function __construct() {
        $this->tags = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Tasks
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Tasks
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
    
    public function getTags() {
        return $this->tags;
    }
    
    public function addTag(\TC\TasksBundle\Entity\Tags $tags){
        $tags->addTask($this);
        $this->tags->add($tags);
    }
    
    public function removeTag(\TC\TasksBundle\Entity\Tags $tag){
        $this->tags->removeElement($tag);
    }


}
