<?php
/**
 * Contestant type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Contestant;
use AppBundle\Entity\School;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ContestantType.
 *
 * @package AppBundle\Form
 */
class ContestantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            TextType::class,
            [
                'label' => 'label.name',
                'required' => true,
                'attr' => [
                    'max_length' => 128,
                ],
            ]
        )
        ->add(
            'surname',
            TextType::class,
            [
                'label' => 'label.surname',
                'required' => true,
                'attr' => [
                    'max_length' => 128,
                ],
            ]
        )
        ->add(
            'sex',
            ChoiceType::class,
            [
                'label' => 'label.sex',
                'choices'  => array(
                    'label.male' => 'm',
                    'label.female' => 'f',
                ),
                // *this line is important*
                'choices_as_values' => true,
            ]
        )
        ->add(
            'school',
            EntityType::class,
            [
                'class' => School::class,
                'choice_label' => function ($school) {
                    return $school->getName();
                },
                'label' => 'label.school',
                'required' => false,
                'multiple' => false,
            ]
        )
        ->add(
            'date_of_birth',
            BirthdayType::class,
            [
                'label' => 'label.date_of_birth',
                'required' => true,
            ]
        )
        ->add(
            'epee',
            CheckboxType::class,
            [
                'label' => 'label.epee',
                'required' => false,
            ]
        )
        ->add(
            'sabre',
            CheckboxType::class,
            [
                'label' => 'label.sabre',
                'required' => false,
            ]
        )
        ->add(
            'rapier',
            CheckboxType::class,
            [
                'label' => 'label.rapier',
                'required' => false,
            ]
        )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Contestant::class,
                'validation_groups' => 'contestant-default',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contestant_type';
    }
}
