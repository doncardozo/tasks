<?php

namespace TC\TasksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tags
 *
 * @ORM\Table(name="tags", indexes={@ORM\Index(name="fk_tags_tasks_idx", columns={"task_id"})})
 * @ORM\Entity
 */
class Tags
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
     * @var \Tasks     
     * @ORM\ManyToOne(targetEntity="Tasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="task_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $task;



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
     * @return Tags
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
     * Get task
     *
     * @return \TC\TasksBundle\Entity\Tasks 
     */
    public function getTask()
    {
        return $this->task;
    }
    
    public function addTask(\TC\TasksBundle\Entity\Tasks $task){
        
        if ($this->task != $task->getId()) {
            $this->task = $task->getId();
        }
    }

}
