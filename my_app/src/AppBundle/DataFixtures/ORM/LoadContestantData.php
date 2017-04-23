<?php
/**
 * Data fixtures for contestants.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Contestant;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTagData.
 *
 * @package AppBundle\DataFixtures\ORM
 */
class LoadContestantData extends AbstractFixture implements ContainerAwareInterface
{
    /**
     * Service container.
     *
     * @var \Symfony\Component\DependencyInjection\ContainerInterface|null $container
     */
    protected $container = null;

    /**
     * Set container.
     *
     * @param ContainerInterface|null $container Service container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $surname = [
            'Bąk',
            'Kowalska'
        ];
        $name = [
            'Jan',
            'Anna'
        ];

        $sex = [
            'm',
            'f'
        ];

        $epee = [
            'true',
            'true'
        ];

        $sabre = [
            'false',
            'true'
        ];

        $rapier = [
            'false',
            'false'
        ];

        foreach ($surname as $item) {
            $contestant = new Contestant();
            $contestant->setSurname($item);
            $manager->persist($contestant);
        }
        foreach ($name as $item) {
            $contestant = new Contestant();
            $contestant->setName($item);
            $manager->persist($contestant);
        }
        foreach ($sex as $item) {
            $contestant = new Contestant();
            $contestant->setSex($item);
            $manager->persist($contestant);
        }
        foreach ($epee as $item) {
            $contestant = new Contestant();
            $contestant->setEpee($item);
            $manager->persist($contestant);
        }
        foreach ($sabre as $item) {
            $contestant = new Contestant();
            $contestant->setSabre($item);
            $manager->persist($contestant);
        }
        foreach ($rapier as $item) {
            $contestant = new Contestant();
            $contestant->setRapier($item);
            $manager->persist($contestant);
        }
        $manager->flush();
    }

}