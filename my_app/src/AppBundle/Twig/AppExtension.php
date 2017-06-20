<?php
/**
 * AppExtension
 */

namespace AppBundle\Twig;

use AppBundle\Entity\Contestant;

/**
 * class AppExtension
 */
class AppExtension extends \Twig_Extension
{
    /**
     * Get Filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
        new \Twig_SimpleFilter('women', array($this, 'womenFilter')),
        );
    }

    /**
     * Women filter
     *
     * @param Contestant $person Contestant
     *
     * @return integer
     */
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
