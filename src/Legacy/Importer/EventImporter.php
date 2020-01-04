<?php

declare(strict_types=1);

namespace App\Legacy\Importer;

use App\Entity\Event;
use DateTimeImmutable;

class EventImporter extends EntityImporter
{
    public function import(array $entityData, array $importedData): object
    {
        $event = new Event(
            $entityData['title'],
            DateTimeImmutable::createFromFormat('d M Y', $entityData['date'])
        );

        if (isset($entityData['meetup-id'])) {
            $event->setMeetupId((string) $entityData['meetup-id']);
        }

        $event->setDescription($entityData['description'] ?? null);
        $event->setVenue($this->lookup(Importer::VENUE, 'venue', $entityData, $importedData));
        $event->setPub($this->lookup(Importer::VENUE, 'pub', $entityData, $importedData));

        $sponsors = $entityData['sponsors'] ?? [];
        foreach ($sponsors as $sponsor) {
            $event->addSponsor($this->lookupValue(Importer::SPONSOR, $sponsor, $importedData));
        }

        $organisers = $entityData['organisers'] ?? [];
        foreach ($organisers as $organiser) {
            $event->addOrganiser($this->lookupValue(Importer::PERSON, $organiser, $importedData));
        }

        return $this->persistIfNew(Event::class, $event, 'date', $event->getDate());
    }
}
