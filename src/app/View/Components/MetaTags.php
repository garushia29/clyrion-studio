<?php

namespace App\View\Components;

use App\Models\SeoSettings;
use Illuminate\View\Component;

/**
 * Component: MetaTags
 *
 * Renderiza etiquetas SEO (title, description, Open Graph)
 * en el head de las páginas públicas. Si no se pasan valores
 * específicos, busca la configuración centralizada de SEO
 * para la ruta actual.
 */
class MetaTags extends Component
{
    public function __construct(
        public string $title = '',
        public string $description = '',
        public ?string $image = null,
        public string $type = 'website',
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
