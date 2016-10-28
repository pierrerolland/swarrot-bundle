<?php

namespace TheFork\SwarrotBundle\Eater;

use TheFork\SwarrotBundle\Model\EaterInterface;

/**
 * Abstract class for resource eaters
 */
abstract class AbstractEater implements EaterInterface
{
    const ROUTING_KEY = '';

    /**
     * {@inheritdoc}
     *
     * @example with static::ROUTINK_KEY = 'example.#' => canEat('example') = false
     * @example with static::ROUTINK_KEY = 'example.#' => canEat('example.1') = true
     * @example with static::ROUTINK_KEY = 'example.#' => canEat('example.42') = true
     * @example with static::ROUTINK_KEY = 'example.#' => canEat('example.routing.1') = true
     */
    public function canEat($msgRoutingKey)
    {
        $pattern = '/^' . str_replace('#', '.+', preg_quote(static::ROUTING_KEY)) . '$/';

        return (bool) preg_match($pattern, $msgRoutingKey);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function eat(array $body);
}
