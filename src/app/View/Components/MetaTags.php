<?php

namespace App\View\Components;

use App\Models\SeoSettings;
use Illuminate\View\Component;

class MetaTags extends Component
{
    public function __construct(
        public string $title = '',
        public string $description = '',
        public ?string $image = null,
        public string $type = 'website',
        public ?string $articlePublished = null,
        public ?string $articleModified = null,
        public ?string $articleAuthor = null,
        public ?string $articleTags = null,
        public ?string $profileFirstName = null,
        public ?string $profileLastName = null,
        public ?string $profileUsername = null,
        public ?string $twitterSite = null,
        public ?string $twitterCreator = null,
        public ?string $fbAppId = null,
        public ?int $imageWidth = null,
        public ?int $imageHeight = null,
    ) {
        $this->resolveFromSeoSettings();
    }

    protected function resolveFromSeoSettings(): void
    {
        if ($this->title !== '') {
            return;
        }

        $routeName = request()->route()?->getName();

        if (!$routeName) {
            $this->title = 'Clyrion Studio | JIMMY — Building scalable digital solutions';
            $this->description = 'Software Engineer & Fullstack Developer especializado en arquitecturas backend.';
            return;
        }

        $seo = SeoSettings::forRoute($routeName);

        if ($seo) {
            $this->title = $seo->title;
            $this->description = $seo->description;
            $this->image = $seo->image;
            $this->type = $seo->type;
        } else {
            $this->title = 'Clyrion Studio | JIMMY — Building scalable digital solutions';
            $this->description = 'Software Engineer & Fullstack Developer especializado en arquitecturas backend.';
        }
    }

    public function render()
    {
        return view('components.meta-tags');
    }
}
