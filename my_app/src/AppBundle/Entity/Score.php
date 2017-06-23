<?php
/**
 * Score entity.
 *
 * @author Dominika Skoczeń <doskoczen@gmail.com>
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Score.
 *
 * @package AppBundle\Entity
 *
 * @ORM\Table(
 *     name="scores"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\ScoreRepository"
 * )
 *
 */
class Score
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;

    /**
     * Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="scores")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * Competitons
     *
     * @ORM\ManyToOne(targetEntity="Competition", inversedBy="scores")
     * @ORM\JoinColumn(name="competition_id", referencedColumnName="id")
     */
    private $competition;

    /**
     * Contestant
     *
     * @ORM\ManyToOne(targetEntity="Contestant", inversedBy="scores")
     * @ORM\JoinColumn(name="contestant_id", referencedColumnName="id")
     */
    private $contestant;


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
     * Place.
     *
     * @var integer $place
     *
     * @ORM\Column(
     *     name="place",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     *
     * @Assert\NotBlank(
     *     groups={"score-default"}
     * )
     *
     * @Assert\GreaterThan(
     *     groups={"score-default"},
     *     value = 0
     * )
     */
    protected $place;

    /**
     * Points.
     *
     * @var integer $points
     *
     * @ORM\Column(
     *     name="points",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     *
     * @Assert\NotBlank(
     *     groups={"score-default"}
     * )
     *
     */
    protected $points;


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
     * Set place
     *
     * @param integer $place
     * @return Score
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return integer
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return Score
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return Score
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set competition
     *
     * @param \AppBundle\Entity\Competition $competition
     * @return Score
     */
    public function setCompetition(\AppBundle\Entity\Competition $competition = null)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \AppBundle\Entity\Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Set contestant
     *
     * @param \AppBundle\Entity\Contestant $contestant
     * @return Score
     */
    public function setContestant(\AppBundle\Entity\Contestant $contestant = null)
    {
        $this->contestant = $contestant;

        return $this;
    }

    /**
     * Get contestant
     *
     * @return \AppBundle\Entity\Contestant
     */
    public function getContestant()
    {
        return $this->contestant;
    }
}
