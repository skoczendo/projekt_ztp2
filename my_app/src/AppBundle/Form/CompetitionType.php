<?php
/**
 * Competition type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\Competition;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CompetitionType.
 *
 * @package AppBundle\Form
 */
class CompetitionType extends AbstractType
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
            'date',
            BirthdayType::class,
            [
                'label' => 'label.date',
                'required' => true,
            ]
        )
        ->add(
            'city',
            EntityType::class,
            [
                'class' => City::class,
                'choice_label' => function ($city) {
                    return $city->getName();
                },
                'label' => 'label.city',
                'required' => true,

                'multiple' => false,
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
                'data_class' => Competition::class,
                'validation_groups' => 'competition-default',
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
        return 'competition_type';
    }
}
