<?php

namespace App\Livewire\Admin;

use App\Models\Import;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tutorial;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ImportManager extends AdminComponent
{
    use WithFileUploads, AuthorizesRequests;

    public $selectedModel = 'posts';
    public $file;
    public $status = 'idle';
    public $message = '';
    public $recentImports;

    protected $rules = [
        'selectedModel' => 'required|in:posts,projects,tutorials',
        'file' => 'required|file|mimes:csv,txt|max:10240',
    ];

    public function mount()
    {
        $this->recentImports = Import::orderBy('created_at', 'desc')->take(10)->get();
    }

    protected function view(): View
    {
        return view('livewire.admin.import-manager');
    }

    public function import()
    {
        $this->validate();

        $this->status = 'processing';
        $this->message = 'Procesando archivo...';

        try {
            $path = $this->file->store('imports');
            $fullPath = Storage::path($path);

            $rows = $this->parseCsv($fullPath);

            $import = Import::create([
                'model_type' => $this->selectedModel,
                'file_path' => $path,
                'file_name' => $this->file->getClientOriginalName(),
                'status' => 'processing',
                'total_rows' => count($rows),
                'user_id' => auth()->id(),
            ]);

            $errors = [];
            $processed = 0;

            foreach ($rows as $index => $row) {
                try {
                    $this->importRow($row, $index + 2);
                    $processed++;
                } catch (\Exception $e) {
                    $errors[] = [
                        'row' => $index + 2,
                        'message' => $e->getMessage(),
                    ];
                }
            }

            $import->update([
                'status' => empty($errors) ? 'completed' : 'completed',
                'processed_rows' => $processed,
                'failed_rows' => count($errors),
                'errors' => $errors,
            ]);

            $this->status = 'completed';
            $this->message = "Importación completada. $processed filas procesadas, " . count($errors) . " errores.";
            $this->recentImports = Import::orderBy('created_at', 'desc')->take(10)->get();

            $this->dispatch('notify', type: count($errors) > 0 ? 'warning' : 'success', message: $this->message);
            $this->file = null;
        } catch (\Exception $e) {
            $this->status = 'error';
            $this->message = 'Error: ' . $e->getMessage();
        }
    }

    public function viewErrors(Import $import)
    {
        $this->dispatch('show-import-errors', errors: $import->errors);
    }

    private function parseCsv(string $path): array
    {
        $handle = fopen($path, 'r');
        $headers = fgetcsv($handle);
        $headers = array_map('trim', $headers);

        $rows = [];
        while (($line = fgetcsv($handle)) !== false) {
            $row = [];
            foreach ($headers as $i => $header) {
                $row[$header] = $line[$i] ?? '';
            }
            $rows[] = $row;
        }

        fclose($handle);
        return $rows;
    }

    private function importRow(array $row, int $lineNumber): void
    {
        switch ($this->selectedModel) {
            case 'posts':
                Post::create([
                    'title' => $row['title'] ?? throw new \Exception("Campo 'title' requerido"),
                    'slug' => $row['slug'] ?? str()->slug($row['title']),
                    'content' => $row['content'] ?? '',
                    'excerpt' => $row['excerpt'] ?? '',
                    'status' => $row['status'] ?? 'draft',
                    'is_featured' => filter_var($row['is_featured'] ?? false, FILTER_VALIDATE_BOOLEAN),
                ]);
                break;

            case 'projects':
                Project::create([
                    'title' => $row['title'] ?? throw new \Exception("Campo 'title' requerido"),
                    'slug' => $row['slug'] ?? str()->slug($row['title']),
                    'description' => $row['description'] ?? '',
                    'content' => $row['content'] ?? '',
                    'is_featured' => filter_var($row['is_featured'] ?? false, FILTER_VALIDATE_BOOLEAN),
                    'sort_order' => (int) ($row['sort_order'] ?? 0),
                ]);
                break;

            case 'tutorials':
                Tutorial::create([
                    'title' => $row['title'] ?? throw new \Exception("Campo 'title' requerido"),
                    'slug' => $row['slug'] ?? str()->slug($row['title']),
                    'content' => $row['content'] ?? '',
                    'excerpt' => $row['excerpt'] ?? '',
                    'status' => $row['status'] ?? 'draft',
                    'sort_order' => (int) ($row['sort_order'] ?? 0),
                ]);
                break;
        }
    }
}
