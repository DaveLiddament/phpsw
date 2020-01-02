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
            Sponsor::FULL,
            $entityData['logo-url'],
            $entityData['website-url'],
        );

        $sponsor->setCurrentSponsor(false);

        return $this->persistIfNew(Sponsor::class, $sponsor, 'name', $sponsor->getName());
    }
}
