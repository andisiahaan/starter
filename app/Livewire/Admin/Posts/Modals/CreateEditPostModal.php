<?php

namespace App\Livewire\Admin\Posts\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateEditPostModal extends ModalComponent
{
    use WithFileUploads;

    public ?int $postId = null;
    public string $title = '';
    public string $slug = '';
    public string $excerpt = '';
    public string $content = '';
    public $thumbnail = null;
    public ?string $existingThumbnail = null;
    public bool $is_published = false;
    public ?string $published_at = null;
    public string $meta_title = '';
    public string $meta_description = '';
    public string $meta_keywords = '';

    public function mount(?int $postId = null): void
    {
        $this->postId = $postId;

        if ($postId) {
            $post = Post::findOrFail($postId);
            $this->title = $post->title;
            $this->slug = $post->slug;
            $this->excerpt = $post->excerpt ?? '';
            $this->content = $post->content;
            $this->existingThumbnail = $post->thumbnail;
            $this->is_published = $post->is_published;
            $this->published_at = $post->published_at?->format('Y-m-d\TH:i');
            $this->meta_title = $post->meta_title ?? '';
            $this->meta_description = $post->meta_description ?? '';
            $this->meta_keywords = $post->meta_keywords ?? '';
        }
    }

    public function updatedTitle($value)
    {
        if (!$this->postId) {
            $this->slug = Str::slug($value);
        }
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $this->postId,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'thumbnail' => $this->postId ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $thumbnailPath = $this->existingThumbnail;
        if ($this->thumbnail) {
            $thumbnailPath = $this->thumbnail->store('posts/thumbnails', 'public');
        }

        $data = [
            'title' => $this->title,
            'slug' => $this->slug ?: Str::slug($this->title),
            'excerpt' => $this->excerpt ?: null,
            'content' => $this->content,
            'thumbnail' => $thumbnailPath,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at ?: ($this->is_published ? now() : null),
            'meta_title' => $this->meta_title ?: null,
            'meta_description' => $this->meta_description ?: null,
            'meta_keywords' => $this->meta_keywords ?: null,
            'author_id' => auth()->id(),
        ];

        if ($this->postId) {
            Post::findOrFail($this->postId)->update($data);
            Toast::success('Post updated successfully.');
        } else {
            Post::create($data);
            Toast::success('Post created successfully.');
        }

        $this->dispatch('refreshPosts');
        $this->closeModal();
    }

    public function removeThumbnail(): void
    {
        $this->existingThumbnail = null;
        $this->thumbnail = null;
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('admin.livewire.posts.modals.create-edit-post-modal');
    }
}
