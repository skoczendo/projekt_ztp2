<?php
/**
 * Search type.
 */
namespace AppBundle\Form;

use AppBundle\Entity\Contestant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SearchType.
 *
 * @package AppBundle\Form
 */
class SearchType extends AbstractType
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
            'surname',
            TextType::class,
            [
                'label' => 'label.surname',
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
                'data_class' => Contestant::class,
                'validation_groups' => 'contestant-search-default',
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
        return 'contestant_search_type';
    }
}
