<?php

namespace Gestion\PassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CameraRangeType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                 ->add('Camera','entity', array(
    'class' => 'GestionPassBundle:Camera',
    'property' => 'nomCamera',))
                
                ->add('dateRange', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'yyyy-MM-dd',
                    'attr' => array('class' => 'form-control'),
                    'label'=>'Date'
                ))
                ->add('heureDebuRange', 'time', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'with_seconds' => true,
                    'attr' => array('class' => 'form-control '),
                    'label'=>'Heure Debut'
                ))
                ->add('heureFinRange', 'time', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',  
                    'with_seconds' => true,
                    'attr' => array('class' => 'form-control'),
                    'label'=>'Heure Fin'
                ))      
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\PassBundle\Entity\CameraRange'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gestion_passbundle_camerarange';
    }

}
