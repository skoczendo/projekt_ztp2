<?php
/**
 * City entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

/**
 * Class City.
 *
 * @package AppBundle\Entity
 *
 * @ORM\Table(
 *     name="cities"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\CityRepository"
 * )
 *
 * @UniqueEntity(
 *     groups={"cities-default"},
 *     fields={"name"}
 * )
 *
 * @AcmeAssert\SafeDelete(
 *     field="competitions",
 *     groups={"cities-delete"},
 * )
 *
 */
class City
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;

    /**
     * @ORM\OneToMany(targetEntity="Competition", mappedBy="city")
     */
    private $competitions;


    /**
     * Primary key.
     *
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Name.
     *
     * @var string $name
     *
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=128,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"city-default"}
     * )
     *
     * @Assert\Length(
     *     groups={"city-default"},
     *     min="3",
     *     max="128",
     * )
     */
    protected $name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->competitions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add competitions
     *
     * @param \AppBundle\Entity\Competition $competitions
     * @return City
     */
    public function addCompetition(\AppBundle\Entity\Competition $competitions)
    {
        $this->competitions[] = $competitions;

        return $this;
    }

    /**
     * Remove competitions
     *
     * @param \AppBundle\Entity\Competition $competitions
     */
    public function removeCompetition(\AppBundle\Entity\Competition $competitions)
    {
        $this->competitions->removeElement($competitions);
    }

    /**
     * Get competitions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }
}
