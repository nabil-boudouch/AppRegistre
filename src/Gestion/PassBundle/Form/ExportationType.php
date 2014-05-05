<?php

namespace Gestion\PassBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExportationType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                
                ->add('beneficiaire', 'text' ,array(
                   'label' => 'Nom bénéficiaire'
               ))
               ->add('organisme', 'choice' , array(                   
                      'choices' => array(
                            'DGSN' =>'DGSN',
                            'PJ' =>'PJ',
                            'GR' =>'Gendarmerie Royale',
                            'DST' =>'DST',
                            'DGED' =>'DGED',
                            'ONDA' =>'ONDA'
                         )
                   ))
            ->add('objet', 'text' ,array(
                   'label' => 'Objet de l\'exportation'
               )) 
                ->add('CameraRanges', 'collection', array(
                    'label' => ' ',
                    'type' => new CameraRangeType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'options' => array(
                        'attr' => array('class' => 'form-group')
                    ),))

        ;

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\PassBundle\Entity\Exportation'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gestion_passbundle_exportation';
    }

}
