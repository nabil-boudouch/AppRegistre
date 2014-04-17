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
                 ->add('Camera')
                ->add('dateRange', 'date', array(
                    'attr' => array('class' => 'form-control datepicker'),
                    'label'=>'Date'
                ))
                ->add('heureDebuRange', 'time', array(
                    'attr' => array('class' => 'form-control '),
                    'label'=>'Heure Debut'
                ))
                ->add('heureFinRange', 'time', array(
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
