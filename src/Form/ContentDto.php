<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Content;
use Symfony\Component\Validator\Constraints;
use Webmozart\Assert\Assert;

class ContentDto
{
    /**
     * @var Content|null
     */
    private $content = null;

    /**
     * @var string|null
     * @Constraints\NotBlank()
     * @Constraints\Length(max="255")
     */
    public $slug;

    /**
     * @var bool
     */
    public $publish;

    /**
     * @var string|null
     * @Constraints\NotBlank()
     * @Constraints\Length(max="255")
     */
    public $title;

    /**
     * @var string|null
     * @Constraints\NotBlank()
     */
    public $copy;

    public static function newInstance(): self
    {
        $contentDto = new self();
        $contentDto->publish = false;

        return $contentDto;
    }

    public static function newInstanceFromContent(Content $content): self
    {
        $contentDto = new self();
        $contentDto->content = $content;
        $contentDto->copy = $content->getCopy();
        $contentDto->slug = $content->getSlug();
        $contentDto->title = $content->getTitle();
        $contentDto->publish = $content->isPublish();

        return $contentDto;
    }

    public function asContent(): Content
    {
        Assert::notNull($this->title);
        Assert::notNull($this->copy);
        Assert::notNull($this->slug);

        if ($this->content) {
            $content = $this->content;

            $content->update($this->slug, $this->title, $this->copy, $this->publish);
        } else {
            $content = new Content($this->slug, $this->title, $this->copy, $this->publish);
        }

        return $content;
    }
}
