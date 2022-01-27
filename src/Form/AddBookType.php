<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Tytuł ',
            ])
            ->add('author', TextType::class, [
                'label' => 'Autor ',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis ',
                'required' => false,
            ])
            ->add('status', CheckboxType::class, [
                'label' => 'Dostępna',
                'required' => false,
                'attr' => array('checked' => 'checked', 'value' => '1'),
            ])
//            ->add('borrowStatus')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
