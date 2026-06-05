<?php

namespace App\Livewire\Admin;

use App\Models\Export;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tutorial;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ExportManager extends AdminComponent
{
    use AuthorizesRequests;

    public $selectedModel = 'posts';
    public $fileType = 'csv';
    public $status = 'idle';
    public $message = '';
    public $recentExports;

    protected $rules = [
        'selectedModel' => 'required|in:posts,projects,tutorials,users',
        'fileType' => 'required|in:csv,pdf',
    ];

    public function mount()
    {
        $this->recentExports = Export::orderBy('created_at', 'desc')->take(10)->get();
    }

    protected function view(): View
    {
        return view('livewire.admin.export-manager');
    }

    public function export()
    {
        $this->validate();

        $this->status = 'processing';
        $this->message = 'Generando exportación...';

        try {
            $data = $this->getData();
            $fileName = $this->selectedModel . '_' . now()->format('Ymd_His');

            if ($this->fileType === 'csv') {
                $filePath = $this->generateCsv($data, $fileName);
            } else {
                $filePath = $this->generatePdf($data, $fileName);
            }

            $export = Export::create([
                'model_type' => $this->selectedModel,
                'file_type' => $this->fileType,
                'file_path' => $filePath,
                'file_name' => $fileName . '.' . $this->fileType,
                'status' => 'completed',
                'filters' => [],
                'user_id' => auth()->id(),
            ]);

            $this->status = 'completed';
            $this->message = 'Exportación completada.';
            $this->recentExports = Export::orderBy('created_at', 'desc')->take(10)->get();

            $this->dispatch('notify', type: 'success', message: 'Exportación completada.');
            $this->dispatch('export-completed', exportId: $export->id);
        } catch (\Exception $e) {
            $this->status = 'error';
            $this->message = 'Error: ' . $e->getMessage();
        }
    }

    public function download(Export $export)
    {
        if (!Storage::exists($export->file_path)) {
            $this->dispatch('notify', type: 'error', message: 'Archivo no encontrado.');
            return;
        }

        return Storage::download($export->file_path, $export->file_name);
    }

    private function getData(): array
    {
        return match ($this->selectedModel) {
            'posts' => Post::with('category')->get()->toArray(),
            'projects' => Project::all()->toArray(),
            'tutorials' => Tutorial::with('series')->get()->toArray(),
            'users' => User::all()->toArray(),
            default => [],
        };
    }

    private function generateCsv(array $data, string $fileName): string
    {
        $path = 'exports/' . $fileName . '.csv';
        $filePath = Storage::path($path);
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $handle = fopen($filePath, 'w');
        fputs($handle, "\xEF\xBB\xBF");

        if (!empty($data)) {
            fputcsv($handle, array_keys($data[0]));
            foreach ($data as $row) {
                $row = array_map(function ($val) {
                    return is_array($val) ? json_encode($val) : $val;
                }, $row);
                fputcsv($handle, $row);
            }
        }

        fclose($handle);

        return $path;
    }

    private function generatePdf(array $data, string $fileName): string
    {
        $viewName = 'exports.' . $this->selectedModel;
        $pdf = Pdf::loadView($viewName, ['items' => $data]);
        $path = 'exports/' . $fileName . '.pdf';
        Storage::put($path, $pdf->output());

        return $path;
    }
}
