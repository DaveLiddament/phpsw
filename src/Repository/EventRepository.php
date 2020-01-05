<?php

namespace App\Repository;

use App\Entity\Event;
use Webmozart\Assert\Assert;

/**
 * @extends AbstractRepository<Event>
 */
class EventRepository extends AbstractRepository
{
    /**
     * @param Event $event
     */
    public function delete($event): void
    {
        Assert::true($event->canDelete());
        parent::delete($event);
    }

    /**
     * @return Event[]
     */
    public function findAll(): iterable
    {
        return $this->getRepository()->findBy([], ['date' => 'DESC']);
    }

    public function findBySlug(string $slug): ?Event
    {
        return $this->getRepository()->findOneBy([
            'slug' => $slug,
        ]);
    }

    public function findByOldSlug(string $slug): ?Event
    {
        return $this->getRepository()->findOneBy([
            'originalRelativeUrl' => $slug,
        ]);
    }

    public function findLatest(): ?Event
    {
        $events = $this->getRepository()->findBy(
            [
            ],
            [
                'date' => 'DESC',
            ],
            1
        );

        return $events[0] ?? null;
    }

    protected function getClassType(): string
    {
        return Event::class;
    }
}
