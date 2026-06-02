<?php

namespace App\Livewire\Traits;

use Illuminate\Support\Str;

/**
 * Trait: WithSlugGeneration
 *
 * Proporciona auto-generación de slug a partir del título
 * con opción a edición manual mediante un toggle.
 */
trait WithSlugGeneration
{
    public bool $showSlugEditor = false;

    public bool $autoSlug = true;

    public function updatedTitleAutoSlug(string $value): void
    {
        if ($this->autoSlug) {
            $this->slug = Str::slug($value);
        }
    }

    public function toggleSlugEditor(): void
    {
        $this->showSlugEditor = !$this->showSlugEditor;

        if ($this->showSlugEditor) {
            $this->autoSlug = false;
        }
    }

    protected function resolveSlug(string $title, string $slug): string
    {
        return $slug ?: Str::slug($title);
    }
}
