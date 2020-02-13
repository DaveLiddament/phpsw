<?php

namespace App\Repository;

use App\Entity\Content;

/**
 * @extends AbstractRepository<Content>
 */
class ContentRepository extends AbstractRepository
{
    /**
     * @param Content $content
     */
    public function delete($content): void
    {
        parent::delete($content);
    }

    /**
     * @return Content[]
     */
    public function findAll(): iterable
    {
        return $this->getRepository()->findBy([], ['slug' => 'ASC']);
    }

    public function findBySlug(string $slug): ?Content
    {
        return $this->getRepository()->findOneBy([
            'slug' => $slug,
        ]);
    }

    protected function getClassType(): string
    {
        return Content::class;
    }
}
