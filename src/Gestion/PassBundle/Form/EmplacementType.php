<?php

namespace Gestion\PassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmplacementType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEmplacement')
            ->add('zone','entity',array(
                'label' => 'Zone',
                'class' => 'GestionPassBundle:Zone',
                'property' => 'nomZone',
                'expanded' => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\PassBundle\Entity\Emplacement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_passbundle_emplacement';
    }
}
