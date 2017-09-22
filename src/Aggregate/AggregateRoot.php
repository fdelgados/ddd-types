<?php

namespace CiscoDelgado\Types\Aggregate;

use function CiscoDelgado\CommonUtilities\StringProcessing\snake_to_camel;
use Shared\Domain\Event\DomainEvent;

abstract class AggregateRoot
{
    /** @var array */
    private $unpublishedEvents = [];

    /** @var int */
    private $version;

    /**
     * @return string
     */
    public function aggregateName(): string
    {
        return get_class($this);
    }

    /**
     * @return int
     */
    public function version(): int
    {
        return $this->version;
    }

    /**
     * @param DomainEvent $aDomainEvent
     */
    protected function raise(DomainEvent $aDomainEvent)
    {
        $this->unpublishedEvents[] = $aDomainEvent;

        $this->version = count($this->unpublishedEvents);
        $this->apply($aDomainEvent);
    }

    /**
     * @param DomainEvent $aDomainEvent
     */
    protected function apply(DomainEvent $aDomainEvent)
    {
        $modifier = 'apply' . ucfirst(snake_to_camel($aDomainEvent->eventName()));

        if (method_exists($this, $modifier)) {
            $this->$modifier($aDomainEvent);
        }
    }

    /**
     * @return array
     */
    public function unpublishedEvents()
    {
        $unpublishedEvents = $this->unpublishedEvents;
        $this->clearUnpublishedEvents();

        return $unpublishedEvents;
    }

    public function clearUnpublishedEvents()
    {
        $this->unpublishedEvents = [];
    }

    /**
     * @return bool
     */
    public abstract function isNull(): bool;
}
