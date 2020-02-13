<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Represents a page of content on the website. (E.g. Code of Conduct).
 *
 * @ORM\Entity()
 * @UniqueEntity("slug")
 */
class Content
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $copy;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $publish;

    public function __construct(string $slug, string $title, string $copy, bool $publish)
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->copy = $copy;
        $this->publish = $publish;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getCopy(): string
    {
        return $this->copy;
    }

    public function isPublish(): bool
    {
        return $this->publish;
    }

    public function update(string $slug, string $title, string $copy, bool $publish): void
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->copy = $copy;
        $this->publish = $publish;
    }
}
