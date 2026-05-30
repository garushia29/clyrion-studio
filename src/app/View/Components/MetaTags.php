<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MetaTags extends Component
{
    public function __construct(
        public string $title = 'Clyrion Studio | JIMMY — Building scalable digital solutions',
        public string $description = 'Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables.',
        public ?string $image = null,
        public string $type = 'website',
    ) {}

    public function render()
    {
        return view('components.meta-tags');
    }
}
