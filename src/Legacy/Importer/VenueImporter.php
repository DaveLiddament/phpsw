<?php

declare(strict_types=1);

namespace App\Legacy\Importer;

use App\Entity\Venue;

class VenueImporter extends EntityImporter
{
    public function import(array $entityData, array $importedData): object
    {
        $venue = new Venue(
            $entityData['name'],
            $entityData['address'],
            $entityData['postcode'],
            Venue::TALK_VENUE,
        );

        $venue->setMapsUrl($entityData['maps-url'] ?? null);
        $venue->setWebsite($entityData['website-url'] ?? null);

        return $this->persistIfNew(Venue::class, $venue, 'name', $venue->getName());
    }
}
