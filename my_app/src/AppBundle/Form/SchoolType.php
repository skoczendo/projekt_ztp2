<?php
/**
 * School type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\School;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SchoolType.
 *
 * @package AppBundle\Form
 */
class SchoolType extends AbstractType
{
    /**
     * BuildForm
     *
     * @param FormBuilderInterface $builder
     * @param FormBuilderInterface $options array
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            TextType::class,
            [
                'label' => 'label.thing.name',
                'required' => true,
                'attr' => [
                    'max_length' => 128,
                ],
            ]
        );
    }

    /**
     * Options
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => School::class,
                'validation_groups' => 'school-default',
            ]
        );
    }

    /**
     * Get Prefix
     *
     * @return 'contestant_type'
     */
    public function getBlockPrefix()
    {
        return 'school_type';
    }
}
