<?php

namespace TC\TasksBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TasksType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')            
        ;
        
        $builder->add('tags', 'collection', array(
            'type'=>new TagsType(),
            'allow_add' => true,
            'prototype' => true,
            'label' => false,
            'by_reference' => true
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TC\TasksBundle\Entity\Tasks'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tc_tasksbundle_tasks';
    }
}
