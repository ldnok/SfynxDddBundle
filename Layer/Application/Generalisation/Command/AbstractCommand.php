<?php

namespace Sfynx\DddBundle\Layer\Application\Generalisation\Command;

use Sfynx\DddBundle\Layer\Application\Generalisation\Interfaces\CommandInterface;

class AbstractCommand implements CommandInterface
{
    /**
     * transform command to array
     * skip null or empty value if $skipNull is true
     *
     * @param bool|false $skipNull
     * @return array
     */
    public function toArray($skipNull = false)
    {
        $tab = get_object_vars($this);
        $tab = is_array($tab) ? $tab : [];

        if ($skipNull) {
            foreach ($tab as $key => $property) {
                if(null === $property || '' === $property){
                    unset($tab[$key]);
                }
            }
        }

        return $tab;
    }
}
