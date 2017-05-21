<?php
/**
 * Score type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Competition;
use AppBundle\Entity\Contestant;
use AppBundle\Entity\Score;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ScoreType.
 *
 * @package AppBundle\Form
 */
class ScoreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'competition',
            EntityType::class,
            [
                'class' => Competition::class,
                'choice_label' => function ($competition) {
                    $date = $competition->getDate();
                    return $date->format('d/m/Y');
                },
                'label' => 'label.competition',
                'required' => true,
                'multiple' => false,
            ]
        )
        ->add(
            'category',
            EntityType::class,
            [
                'class' => Category::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                },
                'label' => 'label.category',
                'required' => true,
                'multiple' => false,
            ]
        )
        ->add(
            'contestant',
            EntityType::class,
            [
                'class' => Contestant::class,
                'choice_label' => function ($contestant) {
                    $surname = $contestant->getSurname();
                    $name = $contestant->getName();
                    return $surname.' '.$name;
                },
                'label' => 'label.contestant',
                'required' => true,
                'multiple' => false,
            ]
        )
        ->add(
            'place',
            IntegerType::class,
            [
                'label' => 'label.place',
                'required' => true,
            ]
        )
        ->add(
            'points',
            IntegerType::class,
            [
                'label' => 'label.points',
                'required' => true,
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
                'data_class' => Score::class,
                'validation_groups' => 'score-default',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'score_type';
    }
}