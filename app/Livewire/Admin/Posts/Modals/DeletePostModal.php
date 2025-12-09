<?php

namespace App\Livewire\Admin\Posts\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class DeletePostModal extends ModalComponent
{
    public int $postId;
    public string $postTitle = '';

    public function mount(int $postId): void
    {
        $this->postId = $postId;
        $post = Post::findOrFail($postId);
        $this->postTitle = $post->title;
    }

    public function delete(): void
    {
        $post = Post::findOrFail($this->postId);
        
        // Delete thumbnail if exists
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        
        $post->delete();
        
        Toast::success('Post deleted successfully.');
        $this->dispatch('refreshPosts');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.posts.modals.delete-post-modal');
    }
}
