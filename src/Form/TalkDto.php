<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Event;
use App\Entity\Person;
use App\Entity\Talk;
use App\Validator\JoindinIdConstraint;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints;
use Webmozart\Assert\Assert;

class TalkDto
{
    /**
     * @var Talk|null
     */
    private $talk = null;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var string|null
     * @Constraints\NotBlank()
     * @Constraints\Length(max="255")
     */
    public $title;

    /**
     * @var string|null
     * @Constraints\Length(max="4096")
     */
    public $abstract;

    /**
     * @var string|null
     * @Constraints\Url()
     * @Constraints\Length(max="255")
     */
    public $slidesUrl;

    /**
     * @var string|null
     * @Constraints\Url()
     * @Constraints\Length(max="255")
     */
    public $videoUrl;

    /**
     * @var string|null
     * @JoindinIdConstraint()
     */
    public $joindinUrl;

    /**
     * @var bool
     */
    public $showcase;

    /**
     * @var Collection<int,Person>
     */
    public $speakers;

    public static function newInstance(Event $event): self
    {
        return new self($event);
    }

    public static function newInstanceFromTalk(Talk $talk): self
    {
        $talkDto = new self($talk->getEvent());
        $talkDto->talk = $talk;
        $talkDto->title = $talk->getTitle();
        $talkDto->abstract = $talk->getAbstract();
        $talkDto->slidesUrl = $talk->getSlidesUrl();
        $talkDto->joindinUrl = $talk->getJoindinUrl();
        $talkDto->videoUrl = $talk->getVideoUrl();
        $talkDto->showcase = $talk->isShowcase();
        $talkDto->speakers = $talk->getSpeakers();

        return$talkDto;
    }

    private function __construct(Event $event)
    {
        $this->event = $event;
        $this->showcase = false;
    }

    public function asTalk(): Talk
    {
        Assert::notNull($this->title);
        Assert::notNull($this->showcase);

        if ($this->talk) {
            $talk = $this->talk;

            $talk->setTitle($this->title);
        } else {
            $talk = new Talk($this->title,
                $this->event);
        }

        $talk->setAbstract($this->abstract);
        $talk->setShowcase($this->showcase);
        $talk->setSlidesUrl($this->slidesUrl);
        $talk->setJoindinUrl($this->joindinUrl);
        $talk->setVideoUrl($this->videoUrl);
        $talk->setSpeakers($this->speakers);

        return $talk;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }
}
