<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Contestant;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
        new \Twig_SimpleFilter('women', array($this, 'womenFilter')),
        );
    }

    public function womenFilter(Contestant $person)
    {
        if ($person['sex'] == "f") {
            return '1';
        }
        else {
            return '0';
        }

    }
}