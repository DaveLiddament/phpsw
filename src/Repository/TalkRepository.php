<?php

namespace App\Repository;

use App\Entity\Talk;

/**
 * @extends AbstractRepository<Talk>
 */
class TalkRepository extends AbstractRepository
{
    /**
     * @param Talk $talk
     */
    public function delete($talk): void
    {
        foreach ($talk->getSpeakers() as $speaker) {
            $talk->removeSpeaker($speaker);
        }
        $talk->getEvent()->removeTalk($talk);
        parent::delete($talk);
    }

    /**
     * @return Talk[]
     */
    public function findShowCase(): iterable
    {
        return $this->getRepository()->findBy([
            'showcase' => true,
        ]);
    }

    public function findBySlug(string $slug): ?Talk
    {
        return $this->getRepository()->findOneBy([
            'slug' => $slug,
        ]);
    }

    protected function getClassType(): string
    {
        return Talk::class;
    }
}
