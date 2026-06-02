<?php

namespace App\Livewire\Admin;

use App\Models\ContentBlock;
use Illuminate\Contracts\View\View;

/**
 * Livewire Component: ContentBlockManager
 *
 * Gestión de bloques de contenido dinámico. Permite crear,
 * editar, activar/desactivar y eliminar bloques con tipos
 * como text, html, image, gallery y json.
 */
class ContentBlockManager extends AdminComponent
{
    public string $key = '';
    public string $label = '';
    public string $type = 'text';
    public string $content = '';
    public bool $is_active = true;
    public int $sort_order = 0;

    public ?ContentBlock $editing = null;

    public bool $showForm = false;

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(ContentBlock $block): void
    {
        $this->editing = $block;
        $this->key = $block->key;
        $this->label = $block->label;
        $this->type = $block->type;
        $this->content = is_array($block->content) ? json_encode($block->content) : $block->content;
        $this->is_active = $block->is_active;
        $this->sort_order = $block->sort_order;
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'key' => $this->key,
            'label' => $this->label,
            'type' => $this->type,
            'content' => $this->parseContent(),
            'is_active' => $this->is_active,
            'sort_order' => (int) $this->sort_order,
        ];

        if ($this->editing?->exists) {
            $this->editing->update($data);
            $this->flashSuccess('Bloque actualizado correctamente.');
        } else {
            ContentBlock::create($data);
            $this->flashSuccess('Bloque creado correctamente.');
        }

        $this->resetForm();
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function toggleActive(ContentBlock $block): void
    {
        $block->update(['is_active' => !$block->is_active]);
    }

    public function delete(ContentBlock $block): void
    {
        $block->delete();
        $this->flashSuccess('Bloque eliminado correctamente.');
    }

    protected function parseContent(): array
    {
        $decoded = json_decode($this->content, true);

        return is_array($decoded) ? $decoded : [$this->content];
    }

    protected function resetForm(): void
    {
        $this->editing = null;
        $this->key = '';
        $this->label = '';
        $this->type = 'text';
        $this->content = '';
        $this->is_active = true;
        $this->sort_order = 0;
        $this->showForm = false;
    }

    protected function rules(): array
    {
        $unique = $this->editing?->exists
            ? 'unique:content_blocks,key,' . $this->editing->id
            : 'unique:content_blocks,key';

        return [
            'key' => "required|string|max:100|{$unique}",
            'label' => 'required|string|max:255',
            'type' => 'required|in:text,html,image,gallery,json',
            'content' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ];
    }

    protected function view(): View
    {
        return view('livewire.admin.content-block-manager', [
            'blocks' => ContentBlock::orderBy('sort_order')
                ->orderBy('label')
                ->get(),
        ]);
    }
}
