<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TalkRepository")
 */
class Talk
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $abstract;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="talks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $originalRelativeUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slidesUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $joindinUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videoUrl;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", inversedBy="talks")
     */
    private $speakers;

    /**
     * @ORM\Column(type="boolean")
     */
    private $showcase;

    public function __construct()
    {
        $this->speakers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getOriginalRelativeUrl(): ?string
    {
        return $this->originalRelativeUrl;
    }

    public function setOriginalRelativeUrl(?string $originalRelativeUrl): self
    {
        $this->originalRelativeUrl = $originalRelativeUrl;

        return $this;
    }

    public function getSlidesUrl(): ?string
    {
        return $this->slidesUrl;
    }

    public function setSlidesUrl(?string $slidesUrl): self
    {
        $this->slidesUrl = $slidesUrl;

        return $this;
    }

    public function getJoindinUrl(): ?string
    {
        return $this->joindinUrl;
    }

    public function setJoindinUrl(?string $joindinUrl): self
    {
        $this->joindinUrl = $joindinUrl;

        return $this;
    }

    public function getVideoUrl(): ?string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(?string $videoUrl): self
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getSpeakers(): Collection
    {
        return $this->speakers;
    }

    public function addSpeaker(Person $speaker): self
    {
        if (!$this->speakers->contains($speaker)) {
            $this->speakers[] = $speaker;
        }

        return $this;
    }

    public function removeSpeaker(Person $speaker): self
    {
        if ($this->speakers->contains($speaker)) {
            $this->speakers->removeElement($speaker);
        }

        return $this;
    }

    public function getShowcase(): ?bool
    {
        return $this->showcase;
    }

    public function setShowcase(bool $showcase): self
    {
        $this->showcase = $showcase;

        return $this;
    }
}
