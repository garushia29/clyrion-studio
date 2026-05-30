<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;

class PostForm extends Component
{
    public ?Post $post = null;

    public $title = '';
    public $slug = '';
    public $excerpt = '';
    public $content = '';
    public $category = '';
    public $tags = '';
    public $status = 'draft';
    public $featured_image = '';
    public $meta_title = '';
    public $meta_description = '';

    public $showSlugEditor = false;
    public $autoSlug = true;

    public function mount(?Post $post = null)
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

    public function updatedTitle($value)
    {
        if ($this->autoSlug) {
            $this->slug = Str::slug($value);
        }
    }

    public function toggleSlugEditor()
    {
        $this->showSlugEditor = !$this->showSlugEditor;
        if ($this->showSlugEditor) {
            $this->autoSlug = false;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug ?: Str::slug($this->title),
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
            session()->flash('message', 'Post actualizado correctamente.');
        } else {
            $data['user_id'] = auth()->id();
            Post::create($data);
            session()->flash('message', 'Post creado correctamente.');
        }

        $this->redirect(route('admin.posts.index'), navigate: true);
    }

    protected function rules()
    {
        $rules = [
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

        return $rules;
    }

    public function render()
    {
        return view('livewire.admin.post-form')->layout('layouts.app');
    }
}
