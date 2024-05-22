<?php

namespace App\Form;

use App\Entity\Cliente;
use App\Entity\ListaProductos;
use App\Entity\Pedido;
use App\Entity\Producto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListaProductosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cantidad')
            ->add('Cliente', EntityType::class, [
                'class' => Cliente::class,
                'choice_label' => 'username',
            ])
            ->add('Articulo', EntityType::class, [
                'class' => Producto::class,
                'choice_label' => 'nombre',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListaProductos::class,
        ]);
    }
}
