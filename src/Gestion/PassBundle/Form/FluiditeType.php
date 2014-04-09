<?php

namespace Gestion\PassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FluiditeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeFluidite','entity', array (
                 'label'  => 'Fluidité',
                 'class'  => 'GestionPassBundle:typeFluidite',
                 'property' => 'typeFluidite'
             ))
       
          ->add('service','choice', array(
                 'choices'  => array(
                      'Informatique' => 'Informatique',
                      'Electrique' => 'Electrique',
                      'Electronique' => 'Electronique',
                      'Electromecanique' => 'Electromecanique',
                      'Maintenance' => 'Maintenance',
                      'Thermique' =>'Thermique',
                      'Exploitation' =>'Exploitation',
                      'Station de base' => 'Station de base',
                     'DGSN' => 'DGSN')
              ))
            ->add('emplacement','entity', array (
                 'label'  => 'Emplacement',
                 'class'  => 'GestionPassBundle:Emplacement',
                 'property' => 'nomEmplacement'
             ))
                ->add('zone','entity', array (
                 'label'  => 'Zone',
                 'class'  => 'GestionPassBundle:Zone',
                 'property' => 'nomZone'
             ))
               ;
                
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\PassBundle\Entity\Fluidite'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_passbundle_fluidite';
    }
}
