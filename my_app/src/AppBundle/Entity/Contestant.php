<?php
/**
 * Contestant entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Contestant.
 *
 * @package AppBundle\Entity
 *
 * @ORM\Table(
 *     name="contestants"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\ContestantRepository"
 * )
 */
class Contestant
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;

    /**
     * @ORM\ManyToOne(targetEntity="School", inversedBy="contestants")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     */
    private $school;

    /**
     * Competitions.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $competitions
     *
     * @ORM\ManyToMany(
     *     targetEntity="Competition",
     *     mappedBy="contestants",
     * )
     */
    protected $competitions;



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
     * Surname.
     *
     * @var string $surname
     *
     * @ORM\Column(
     *     name="surname",
     *     type="string",
     *     length=128,
     *     nullable=false,
     * )
     */
    protected $surname;

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
     *     groups={"contestant-default"}
     * )
     *
     * @Assert\Length(
     *     groups={"contestant-default"},
     *     min="3",
     *     max="128",
     * )
     */
    protected $name;


    /**
     * Sex.
     *
     * @var string $sex
     *
     * @ORM\Column(
     *     name="sex",
     *     type="string",
     *     length=1,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"contestant-default"}
     * )
     */
    protected $sex;

    /**
     * Date of birth.
     *
     * @var string $date_of_birth
     *
     * @ORM\Column(
     *     name="date_of_birth",
     *     type="date",
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"contestant-default"}
     * )
     */
    protected $date_of_birth;

    /**
     * Epee.
     *
     * @var boolean $epee
     *
     * @ORM\Column(
     *     name="epee",
     *     type="boolean",
     * )
     */
    protected $epee;

    /**
     * Sabre.
     *
     * @var boolean $sabre
     *
     * @ORM\Column(
     *     name="sabre",
     *     type="boolean",
     * )
     */
    protected $sabre;

    /**
     * Rapier.
     *
     * @var boolean $rapier
     *
     * @ORM\Column(
     *     name="rapier",
     *     type="boolean",
     * )
     */
    protected $rapier;



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
     * Set surname
     *
     * @param string $surname
     * @return Contestant
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Contestant
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
     * Set sex
     *
     * @param string $sex
     * @return Contestant
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set epee
     *
     * @param boolean $epee
     * @return Contestant
     */
    public function setEpee($epee)
    {
        $this->epee = $epee;

        return $this;
    }

    /**
     * Get epee
     *
     * @return boolean 
     */
    public function getEpee()
    {
        return $this->epee;
    }

    /**
     * Set sabre
     *
     * @param boolean $sabre
     * @return Contestant
     */
    public function setSabre($sabre)
    {
        $this->sabre = $sabre;

        return $this;
    }

    /**
     * Get sabre
     *
     * @return boolean 
     */
    public function getSabre()
    {
        return $this->sabre;
    }

    /**
     * Set rapier
     *
     * @param boolean $rapier
     * @return Contestant
     */
    public function setRapier($rapier)
    {
        $this->rapier = $rapier;

        return $this;
    }

    /**
     * Get rapier
     *
     * @return boolean 
     */
    public function getRapier()
    {
        return $this->rapier;
    }

    /**
     * Set date_of_birth
     *
     * @param string $dateOfBirth
     * @return Contestant
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->date_of_birth = $dateOfBirth;

        return $this;
    }

    /**
     * Get date_of_birth
     *
     * @return string 
     */
    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    /**
     * Set school
     *
     * @param \AppBundle\Entity\School $school
     * @return Contestant
     */
    public function setSchool(\AppBundle\Entity\School $school = null)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return \AppBundle\Entity\School 
     */
    public function getSchool()
    {
        return $this->school;
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
     * @return Contestant
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
