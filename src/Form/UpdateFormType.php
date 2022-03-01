<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class UpdateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', Null,[
                'label' => 'Nom :',
                'attr' => ['autocomplete' => 'email'],


            ])
            ->add('prenom',Null,[
                'label' => 'Prénom :'
            ])
            ->add('email',Null,[
                'label' => 'Email :'
            ])
            ->add('telephone',
                Null,[
                    'label' => 'Téléphone :'
                ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Nouveau mot de passe :',
                    'attr' => [
                        'maxlength' => 50
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation mot de passe :',
                    'attr' => [
                        'maxlength' => 50
                    ]
                ]
            ])
            ->add('pseudo',
                Null,[
                    'label' => 'Pseudo :'
                ])

            ->add('photo', FileType::class, [
                'label' => 'photo :',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => false,
                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ]);


    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}