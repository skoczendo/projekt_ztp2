<?php
/**
 * User entity.
 */
namespace UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class user
 *
 * @ORM\Entity
 * @ORM\Table(
 *     name="fos_user"
 * )
 */
class User extends BaseUser
{
    const NUM_ITEMS = 2;

    /**
     * Id
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
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}
