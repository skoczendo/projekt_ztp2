<?php
/**
 * School entity.
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class School.
 *
 * @package AppBundle\Entity
 *
 * @ORM\Table(
 *     name="schools"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\SchoolRepository"
 * )
 *
 * @UniqueEntity(
 *     groups={"schools-default"},
 *     fields={"name"}
 * )
 */
class School
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;


    /**
     * @ORM\OneToMany(targetEntity="Contestant", mappedBy="school")
     */
    private $contestants;

    public function __construct()
    {
        $this->contestants = new ArrayCollection();
    }


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
     *     groups={"school-default"}
     * )
     *
     * @Assert\Length(
     *     groups={"school-default"},
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
     * @return School
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
     * Add contestants
     *
     * @param \AppBundle\Entity\Contestant $contestants
     * @return School
     */
    public function addContestant(\AppBundle\Entity\Contestant $contestants)
    {
        $this->contestants[] = $contestants;

        return $this;
    }

    /**
     * Remove contestants
     *
     * @param \AppBundle\Entity\Contestant $contestants
     */
    public function removeContestant(\AppBundle\Entity\Contestant $contestants)
    {
        $this->contestants->removeElement($contestants);
    }

    /**
     * Get contestants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContestants()
    {
        return $this->contestants;
    }
}
