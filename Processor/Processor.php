<?php

namespace TheFork\SwarrotBundle\Processor;

use Swarrot\Broker\Message;
use Swarrot\Processor\ProcessorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use TheFork\SwarrotBundle\Model\EaterInterface;

/**
 * Swarrot Processor
 */
class Processor implements ProcessorInterface
{
    /**
     * @var JsonEncoder
     */
    protected $encoder;

    /**
     * @var EaterInterface[]
     */
    protected $eaters;

    /**
     * @param JsonEncoder $encoder
     */
    public function __construct(JsonEncoder $encoder)
    {
        $this->encoder = $encoder;
        $this->eaters = [];
    }

    /**
     * {@inheritdoc}
     *
     * Returns true if an eater able to process the message has been found. False otherwise
     */
    public function process(Message $message, array $options)
    {
        foreach ($this->getEaters() as $eater) {
            if ($eater->canEat($message->getProperties()['routing_key'])) {
                $eater->eat($this->encoder->decode($message->getBody(), 'json'));

                return true;
            }
        }

        return false;
    }

    /**
     * @param EaterInterface $eater
     */
    public function addEater(EaterInterface $eater)
    {
        $this->eaters[] = $eater;
    }

    /**
     * @return EaterInterface[]
     */
    public function getEaters()
    {
        return $this->eaters;
    }
}
