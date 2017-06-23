<?php
/**
 * Baza zawodów.
 *
 * @author Dominika Skoczeń <doskoczen@gmail.com>
 */
namespace AppBundle\Repository;

use AppBundle\Entity\School;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * SchoolRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SchoolRepository extends EntityRepository
{
    /**
     * Save entity.
     *
     * @param School $school School entity
     */
    public function save(School $school)
    {
        $this->_em->persist($school);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param School $school School entity
     */
    public function delete(School $school)
    {
        $this->_em->remove($school);
        $this->_em->flush();
    }

    /**
     * Gets all records paginated.
     *
     * @param int $page Page number
     *
     * @return \Pagerfanta\Pagerfanta Result
     */
    public function findAllPaginated($page = 1)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($this->queryAll(), false));
        $paginator->setMaxPerPage(School::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    /**
     * Query all entities.
     *
     * @return \Doctrine\ORM\Query
     */
    protected function queryAll()
    {
        $qb = $this->createQueryBuilder('b');
        $qb->select('b')
            ->orderBy('b.name', 'ASC');

        return $qb;
    }
}
