<?php
/**
 * SafeDelete.
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class SafeDeleteValidator
 *
 * @Annotation
 */
class SafeDelete extends Constraint
{
    public $message = 'Nie mozesz usunac rekordu bo jest powiazany z innymi danymi.';

    public $field;

    /**
     * Get Targets.
     *
     * @return Symfony\Component\Validator\Constraint
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
