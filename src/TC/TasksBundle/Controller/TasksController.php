<?php

namespace TC\TasksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TC\TasksBundle\Entity\Tasks;
use TC\TasksBundle\Form\TasksType;
use TC\TasksBundle\Entity\Repository\TasksRepository;

class TasksController extends Controller {

    public function indexAction() {
        return $this->render("TasksBundle:Tasks:index.html.twig");
    }

    public function newAction(Request $request) {
        
        $entity = new Tasks();
        $form = $this->createCreateForm($entity);
        
        return $this->render("TasksBundle:Tasks:new.html.twig", array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    private function createCreateForm(Tasks $entity){
        
        $form = $this->createForm(new TasksType(), $entity, array(
            'method' => 'post',
            'action' => $this->generateUrl("tasks_create")
        ));
        
        $form->add("submit", "submit");
        
        return $form;        
    }

    public function createAction(Request $request){
        
        $entity = new Tasks();
        
        $form = $this->createCreateForm($entity);
        
        $form->handleRequest($request);
        
        if($form->isValid()){
            
            $em = $this->getDoctrine()->getManager();

            $id = $em->getRepository('TasksBundle:Tasks')->createTask($entity);
                        
            $result = $em->getRepository('TasksBundle:Tasks')->getTasks();
            
            return $this->render("TasksBundle:Tasks:index.html.twig", array(
                "entities" => $result
            ));            
        }
        
        return $this->render("TasksBundle:Tasks:new.html.twig", array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }
    
    public function listAction(){
        
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('TasksBundle:Tasks')->getTasks();
            
        return $this->render("TasksBundle:Tasks:index.html.twig", array(
            "entities" => $result
        )); 
    }
}
