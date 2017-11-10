<?php
namespace AppBundle\Form;

use AppBundle\Entity\User;
use FOS\UserBundle\Form\Type\ProfileFormType;
use Symfony\Component\Form\Extension\Core\Type\{
    CollectionType, FileType, TextareaType, TextType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends RegistrationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub

        $builder
            ->add('role', TextType::class)
            ->add('headline', TextareaType::class)
            ->add('photo', TextType::class)
            ->add('background', TextType::class)
            ->add('country', TextType::class)
            ->add('state', TextType::class)
            ->add('city', TextType::class)
            ->add('summary', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function getParent()
    {
        return ProfileFormType::class;
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}