<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Livewire\Traits\WithSlugGeneration;
use Illuminate\Support\Str;

/**
 * Livewire Component: PostForm
 *
 * Formulario de creación y edición de posts del blog.
 * Soporta tags como string, categoría, imagen destacada y meta SEO.
 */
class PostForm extends AdminComponent
{
    use WithSlugGeneration;

    public ?Post $post = null;

    public string $title = '';
    public string $slug = '';
    public string $excerpt = '';
    public string $content = '';
    public string $category = '';
    public string $tags = '';
    public string $status = 'draft';
    public string $featured_image = '';
    public string $meta_title = '';
    public string $meta_description = '';

    public function mount(?Post $post = null): void
    {
        if ($post?->exists) {
            $this->post = $post;
            $this->title = $post->title;
            $this->slug = $post->slug;
            $this->excerpt = $post->excerpt;
            $this->content = $post->content;
            $this->category = $post->category;
            $this->tags = $post->tags ? implode(', ', $post->tags) : '';
            $this->status = $post->status;
            $this->featured_image = $post->featured_image;
            $this->meta_title = $post->meta_title;
            $this->meta_description = $post->meta_description;
            $this->autoSlug = false;
        }
    }

    public function updatedTitle(string $value): void
    {
        $this->updatedTitleAutoSlug($value);
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->resolveSlug($this->title, $this->slug),
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'category' => $this->category,
            'tags' => $this->tags ? array_map('trim', explode(',', $this->tags)) : [],
            'status' => $this->status,
            'featured_image' => $this->featured_image,
            'meta_title' => $this->meta_title ?: $this->title,
            'meta_description' => $this->meta_description ?: $this->excerpt,
            'published_at' => $this->status === 'published' ? now() : null,
        ];

        if ($this->post?->exists) {
            $this->post->update($data);
            $this->flashSuccess('Post actualizado correctamente.');
        } else {
            $data['user_id'] = auth()->id();
            Post::create($data);
            $this->flashSuccess('Post creado correctamente.');
        }

        $this->redirect(route('admin.posts.index'), navigate: true);
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ];
    }

    protected function view(): \Illuminate\Contracts\View\View
    {
        return view('livewire.admin.post-form');
    }
}
