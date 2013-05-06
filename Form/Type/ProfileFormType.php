<?php

namespace Ripple\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseForm;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Profile form type.
 *
 * Overrides functionality provided by FOSUserBundle to allow additional field editiing
 *
 * @package Ripple\UserBundle\Form\Type
 * @author  James Halsall <jhalsall@rippleffect.com>
 */
class ProfileFormType extends BaseForm
{
    /**
     * {@inheritDoc}
     *
     * @param FormBuilderInterface $builder The form build object
     * @param array                $options An array of additional options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('forename')
                ->add('surname');
    }

    /**
     * Gets the form alias
     *
     * @return string
     */
    public function getName()
    {
        return 'ripple_user_profile';
    }
}
