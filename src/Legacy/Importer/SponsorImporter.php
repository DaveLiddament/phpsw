<?php

declare(strict_types=1);

namespace App\Legacy\Importer;

use App\Entity\Sponsor;

class SponsorImporter extends EntityImporter
{
    public function import(array $entityData, array $importedData): object
    {
        $sponsor = new Sponsor(
            $entityData['name'],
            $entityData['sponsor-type'],
            $entityData['logo-url'],
            $entityData['website-url'],
        );

        $sponsor->setCurrentSponsor($entityData['current']);

        return $this->persistIfNew(Sponsor::class, $sponsor, 'name', $sponsor->getName());
    }
}
