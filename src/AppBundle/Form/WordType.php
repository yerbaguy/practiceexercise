<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('engWord', 'text')
             ->add('plWord', 'text')
             //->add('save', SubmitType::class)
             ->add('save', 'submit')
        ;
        //);  
    }

    public function setDefaultOption(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
              'data_class' => 'AppBundle\Entity\Word',
          ));    
    }

    public function getName()
    {
        //return 'word';
        return 'engWord';
    }

}
