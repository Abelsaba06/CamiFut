<?php

namespace App\Form;

use App\Entity\Camiseta;
use App\Entity\Categoria;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CamisetaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('equipo')
            ->add('imagen')
            ->add('temporada')
            ->add('precio')
            ->add('categoria', EntityType::class, [
                'class' => Categoria::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Camiseta::class,
        ]);
    }
}
