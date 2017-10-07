<?php

namespace AppBundle\Form;

use AppBundle\Entity\Bubble;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BubbleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('message', TextareaType::class, array(
      'label' => false,
      'attr' => array('maxlength' => 180),
    ));
    $builder->add('create', SubmitType::class, array('label' => 'Fortæl os din mening'));
  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
      'data_class' => Bubble::class,
    ));
  }
}
