<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Venue;
use Symfony\Component\Validator\Constraints;
use Webmozart\Assert\Assert;

class VenueDto
{
    /**
     * @var Venue|null
     */
    private $venue;

    /**
     * @var string|null
     * @Constraints\NotBlank()
     * @Constraints\Length(max="255")
     */
    public $name;

    /**
     * @var string|null
     * @Constraints\NotBlank()
     * @Constraints\Length(max="255")
     */
    public $address;

    /**
     * @var string|null
     * @Constraints\NotBlank()
     * @Constraints\Length(max="255")
     */
    public $postcode;

    /**
     * @var string|null
     * @Constraints\Length(max="255")
     */
    public $mapsUrl;

    /**
     * @var string|null
     * @Constraints\Length(max="255")
     */
    public $website;

    /**
     * @var string|null
     * @Constraints\NotBlank()
     * @Constraints\Length(max="255")
     */
    public $type;

    public function __construct(?Venue $venue)
    {
        $this->venue = $venue;
        if ($venue) {
            $this->address = $venue->getAddress();
            $this->mapsUrl = $venue->getMapsUrl();
            $this->name = $venue->getName();
            $this->postcode = $venue->getPostcode();
            $this->type = $venue->getType();
            $this->website = $venue->getWebsite();
        }
    }

    public function asVenue(): Venue
    {
        Assert::notNull($this->name);
        Assert::notNull($this->address);
        Assert::notNull($this->postcode);
        Assert::notNull($this->type);

        if ($this->venue) {
            $venue = $this->venue;

            $venue->setAddress($this->address);
            $venue->setName($this->name);
            $venue->setPostcode($this->postcode);
            $venue->setType($this->type);
        } else {
            $venue = new Venue($this->name, $this->address, $this->postcode, $this->type);
        }

        $venue->setMapsUrl($this->mapsUrl);
        $venue->setWebsite($this->website);

        return $venue;
    }
}
