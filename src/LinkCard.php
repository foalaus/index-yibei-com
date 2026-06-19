<?php

namespace App\Render;

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $imageUrl;

    public function __construct(
        string $url = 'https://index-yibei.com',
        string $title = '易倍体育',
        string $description = '易倍体育提供丰富的体育赛事资讯与互动体验。',
        string $imageUrl = ''
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedImageUrl = htmlspecialchars($this->imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $imageHtml = '';
        if ($escapedImageUrl !== '') {
            $imageHtml = '<img src="' . $escapedImageUrl . '" alt="' . $escapedTitle . '" class="link-card-image" />';
        }

        return '<div class="link-card">' . "\n"
            . '    <a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer" class="link-card-link">' . "\n"
            . '        <div class="link-card-content">' . "\n"
            . '            <span class="link-card-title">' . $escapedTitle . '</span>' . "\n"
            . '            <p class="link-card-description">' . $escapedDescription . '</p>' . "\n"
            . '        </div>' . "\n"
            . '        ' . $imageHtml . "\n"
            . '    </a>' . "\n"
            . '</div>';
    }

    public static function createDefault(): self
    {
        return new self(
            'https://index-yibei.com',
            '易倍体育',
            '易倍体育——专注体育赛事与社区互动。',
            ''
        );
    }

    public static function fromArray(array $data): self
    {
        $card = new self();
        if (isset($data['url'])) {
            $card->setUrl($data['url']);
        }
        if (isset($data['title'])) {
            $card->setTitle($data['title']);
        }
        if (isset($data['description'])) {
            $card->setDescription($data['description']);
        }
        if (isset($data['image_url'])) {
            $card->setImageUrl($data['image_url']);
        }
        return $card;
    }
}