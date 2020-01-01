<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Venue
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $postcode;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mapsUrl;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @var Collection<int,Event>
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="pub")
     */
    private $pubs;

    /**
     * @var ArrayCollection<int,Event>
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="venue")
     */
    private $events;

    public function __construct()
    {
        $this->pubs = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getMapsUrl(): ?string
    {
        return $this->mapsUrl;
    }

    public function setMapsUrl(?string $mapsUrl): self
    {
        $this->mapsUrl = $mapsUrl;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int,Event>
     */
    public function getPubs(): Collection
    {
        return $this->pubs;
    }

    public function addPub(Event $pub): self
    {
        if (!$this->pubs->contains($pub)) {
            $this->pubs[] = $pub;
            $pub->setVenue($this);
        }

        return $this;
    }

    public function removePub(Event $pub): self
    {
        if ($this->pubs->contains($pub)) {
            $this->pubs->removeElement($pub);
            // set the owning side to null (unless already changed)
            if ($pub->getVenue() === $this) {
                $pub->setVenue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int,Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setPub($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getPub() === $this) {
                $event->setPub(null);
            }
        }

        return $this;
    }
}
