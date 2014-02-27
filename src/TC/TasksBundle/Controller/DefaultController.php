<?php

namespace TC\TasksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TC\TasksBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use TC\TasksBundle\Form\TaskType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TasksBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function successAction()
    {
        return $this->render('TasksBundle:Default:success.html.twig');
    }
    
    public function newAction(Request $request)
    {
        
        $task = new Task();
        $task->setDueDate(new \DateTime('tomorrow'));
        
        $form = $this->createForm(new TaskType(), $task);
        $form->add("Save", "submit");
        
        $form->handleRequest($request);
        
        if($form->isValid()){
            return $this->redirect($this->generateUrl("tasks_success"));
        }
 
        return $this->render('TasksBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
