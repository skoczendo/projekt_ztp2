<?php
/**
 * Category entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Category.
 *
 * @package AppBundle\Entity
 *
 * @ORM\Table(
 *     name="categories"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\CategoryRepository"
 * )
 *
 * @UniqueEntity(
 *     groups={"categories-default"},
 *     fields={"name"}
 * )
 */
class Category
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;

    /**
     * Scores
     *
     * @ORM\OneToMany(targetEntity="Score", mappedBy="category")
     */
    private $scores;

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
     *     groups={"category-default"}
     * )
     *
     * @Assert\Length(
     *     groups={"category-default"},
     *     min="3",
     *     max="128",
     * )
     */
    protected $name;




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->score = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Category
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
     * Add score
     *
     * @param \AppBundle\Entity\Score $score
     * @return Category
     */
    public function addScore(\AppBundle\Entity\Score $score)
    {
        $this->score[] = $score;

        return $this;
    }

    /**
     * Remove score
     *
     * @param \AppBundle\Entity\Score $score
     */
    public function removeScore(\AppBundle\Entity\Score $score)
    {
        $this->score->removeElement($score);
    }

    /**
     * Get score
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Get scores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScores()
    {
        return $this->scores;
    }
}
