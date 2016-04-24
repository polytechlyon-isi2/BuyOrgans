<?php
namespace BuyOrgans\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', 'text', array(
                'label' => 'City','required' => false))
            ->add('address', 'text', array(
                'label' => 'Address','required' => false))
            ->add('postalcode', 'text', array(
                'label' => 'Postal code','required' => false));
    }

    public function getName()
    {
        return 'user';
    }
}