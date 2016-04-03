<?php
namespace BuyOrgans\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'label' => 'Mail'))
            ->add('userdisplayedname', 'text', array(
                'label' => 'Displayed username'))
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'The password fields must match.',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Password'),
                'second_options'  => array('label' => 'Repeat password'),
            ))
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