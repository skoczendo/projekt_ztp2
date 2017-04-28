<?php
/**
 * Competition entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Competition.
 *
 * @package AppBundle\Entity
 *
 * @ORM\Table(
 *     name="competitions"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\CompetitionRepository"
 * )
 */
class Competition
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;


    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="competitions")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;



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
     * Date.
     *
     * @var string $date
     *
     * @ORM\Column(
     *     name="date",
     *     type="date",
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"competition-default"}
     * )
     */
    protected $date;



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
     * Set date
     *
     * @param \DateTime $date
     * @return Competition
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set city
     *
     * @param \AppBundle\Entity\City $city
     * @return Competition
     */
    public function setCity(\AppBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \AppBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }
}
