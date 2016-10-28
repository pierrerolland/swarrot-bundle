<?php

namespace TheFork\SwarrotBundle\Model;

/**
 * Interface for resource eaters
 */
interface EaterInterface
{
    /**
     * @param string $routingKey
     *
     * @return bool
     */
    public function canEat($routingKey);

    /**
     * @param array $body
     */
    public function eat(array $body);
}
