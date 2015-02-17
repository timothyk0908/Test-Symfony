<?php
// src/OC/PlatformBundle/Form/AdvertType.php

namespace TK\PresentationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdvertType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('date',      'date')
      ->add('title',     'text')
      ->add('author',    'text')
      ->add('content',   'textarea')
      ->add('published', 'checkbox', array('required' => false))
      ->add('image',     new ImageType())
      ->add('save',      'submit')
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'TK\PresentationBundle\Entity\Advert'
    ));
  }

  public function getName()
  {
    return 'tk_presentationbundle_advert';
  }
}   