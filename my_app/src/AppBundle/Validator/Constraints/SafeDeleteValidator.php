<?php
/**
 * SafeDelete Validator.
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\PropertyAccess\PropertyAccess;

class SafeDeleteValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        $related_fields = $accessor->getValue($value, $constraint->field);
        $counted = $related_fields->count();


        if ($counted) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }

    }
}