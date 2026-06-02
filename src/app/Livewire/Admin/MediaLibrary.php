<?php

namespace App\Livewire\Admin;

use App\Models\Media;
use Livewire\WithFileUploads;
use App\Livewire\Traits\WithListPagination;
use Illuminate\Support\Facades\Storage;

/**
 * Livewire Component: MediaLibrary
 *
 * Biblioteca multimedia con subida de archivos, búsqueda
 * y eliminación. Soporta imágenes, documentos y más.
 */
class MediaLibrary extends AdminComponent
{
    use WithFileUploads, WithListPagination;

    public $upload;

    protected int $perPage = 30;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected function rules(): array
    {
        return [
            'upload' => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg,pdf,doc,docx|max:10240',
        ];
    }

    public function uploadFile(): void
    {
        $this->validate();

        $file = $this->upload;
        $originalName = $file->getClientOriginalName();
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $storedName = time() . '_' . str_replace(' ', '_', $name) . '.' . $extension;

        $path = $file->storeAs('uploads', $storedName, 'public');

        Media::create([
            'name' => $name,
            'original_name' => $originalName,
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'user_id' => auth()->id(),
        ]);

        $this->reset('upload');
        $this->flashSuccess('Archivo subido correctamente.');
    }

    public function delete(Media $media): void
    {
        Storage::disk('public')->delete($media->path);
        $media->delete();
        $this->flashSuccess('Archivo eliminado correctamente.');
    }

    protected function view(): \Illuminate\Contracts\View\View
    {
        return view('livewire.admin.media-library', [
            'mediaItems' => $this->applySearch(Media::query(), ['name'])
                ->orderByDesc('created_at')
                ->paginate($this->perPage),
        ]);
    }
}
