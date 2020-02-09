<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CustomFilters extends AbstractExtension
{
    /** @return TwigFilter[] */
    public function getFilters(): array
    {
        return [
            new TwigFilter('nullToEmpty', [$this, 'nullToEmpty']),
            new TwigFilter('github', [$this, 'github'], ['is_safe' => ['all']]),
            new TwigFilter('twitter', [$this, 'twitter'], ['is_safe' => ['all']]),
            new TwigFilter('website', [$this, 'website'], ['is_safe' => ['all']]),
            new TwigFilter('meetupMember', [$this, 'meetupMember'], ['is_safe' => ['all']]),
            new TwigFilter('meetupEvent', [$this, 'meetupEvent'], ['is_safe' => ['all']]),
            new TwigFilter('joindin', [$this, 'joindin'], ['is_safe' => ['all']]),
        ];
    }

    public function nullToEmpty(?string $text): string
    {
        return $text ?? '';
    }

    public function github(?string $githubhandle): string
    {
        if (null === $githubhandle) {
            return '';
        }

        return "<a href=\"https://github.com/$githubhandle\">$githubhandle</a>";
    }

    public function twitter(?string $twitterhandle): string
    {
        if (null === $twitterhandle) {
            return '';
        }

        return "<a href=\"https://twitter.com/$twitterhandle\">$twitterhandle</a>";
    }

    public function meetupMember(?string $meetupId): string
    {
        if (null === $meetupId) {
            return '';
        }

        return "<a href=\"https://meetup.com/php-sw/members/$meetupId/\">$meetupId</a>";
    }

    public function meetupEvent(?string $meetupId): string
    {
        if (null === $meetupId) {
            return '';
        }

        return "<a href=\"https://meetup.com/php-sw/events/$meetupId/\">$meetupId</a>";
    }

    public function website(?string $website): string
    {
        if (null === $website) {
            return '';
        }

        return "<a href=\"$website\">$website</a>";
    }

    public function joindin(?string $joindin): string
    {
        if (null === $joindin) {
            return '';
        }

        return "<a href=\"https://joind.in/user/$joindin/\">$joindin</a>";
    }
}
