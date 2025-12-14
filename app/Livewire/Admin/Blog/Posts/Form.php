<?php

namespace App\Livewire\Admin\Blog\Posts;

use App\Helpers\Toast;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{
    use WithFileUploads;

    public ?BlogPost $post = null;
    
    // Form fields
    public string $title = '';
    public string $slug = '';
    public string $excerpt = '';
    public string $content = '';
    public $featured_image;
    public ?string $existing_image = null;
    public string $status = 'draft';
    public ?string $published_at = null;
    public bool $is_featured = false;
    public bool $allow_comments = true;
    public string $meta_title = '';
    public string $meta_description = '';
    public string $meta_keywords = '';
    
    public array $selected_categories = [];
    public array $selected_tags = [];

    // Inline creation
    public string $newCategoryName = '';
    public string $newTagName = '';
    public bool $showNewCategoryInput = false;
    public bool $showNewTagInput = false;
    
    public $isEditing = false;

    public function mount(?BlogPost $post = null)
    {
        if ($post) {
            $this->post = $post;
            $this->title = $this->post->title;
            $this->slug = $this->post->slug;
            $this->excerpt = $this->post->excerpt ?? '';
            $this->content = $this->post->content;
            $this->existing_image = $this->post->featured_image;
            $this->status = $this->post->status;
            $this->published_at = $this->post->published_at?->format('Y-m-d\TH:i');
            $this->is_featured = $this->post->is_featured;
            $this->allow_comments = $this->post->allow_comments;
            $this->meta_title = $this->post->meta_title ?? '';
            $this->meta_description = $this->post->meta_description ?? '';
            $this->meta_keywords = $this->post->meta_keywords ?? '';
            $this->selected_categories = $this->post->categories->pluck('id')->toArray();
            $this->selected_tags = $this->post->tags->pluck('id')->toArray();
            $this->isEditing = true;
        }
    }

    public function generateSlug()
    {
        $this->slug = \Str::slug($this->title);
    }

    /**
     * Create a new category inline.
     */
    public function createCategory(): void
    {
        $this->validate([
            'newCategoryName' => 'required|string|max:255|unique:blog_categories,name',
        ], [
            'newCategoryName.required' => __('blog.categories.validation.name_required'),
            'newCategoryName.unique' => __('blog.categories.validation.name_unique'),
        ]);

        $category = BlogCategory::create([
            'name' => $this->newCategoryName,
            'slug' => \Str::slug($this->newCategoryName),
            'is_active' => true,
        ]);

        // Auto-select the new category
        $this->selected_categories[] = $category->id;
        $this->newCategoryName = '';
        $this->showNewCategoryInput = false;
        
        Toast::success(__('blog.categories.created'));
    }

    /**
     * Create a new tag inline.
     */
    public function createTag(): void
    {
        $this->validate([
            'newTagName' => 'required|string|max:255|unique:blog_tags,name',
        ], [
            'newTagName.required' => __('blog.tags.validation.name_required'),
            'newTagName.unique' => __('blog.tags.validation.name_unique'),
        ]);

        $tag = BlogTag::create([
            'name' => $this->newTagName,
            'slug' => \Str::slug($this->newTagName),
        ]);

        // Auto-select the new tag
        $this->selected_tags[] = $tag->id;
        $this->newTagName = '';
        $this->showNewTagInput = false;
        
        Toast::success(__('blog.tags.created'));
    }

    public function save()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . ($this->post?->id),
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published,scheduled,archived',
            'published_at' => 'nullable|date',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'selected_categories' => 'array',
            'selected_tags' => 'array',
        ];

        $this->validate($rules);

        // Handle image upload
        $imagePath = $this->existing_image;
        if ($this->featured_image) {
            // Delete old image if exists
            if ($this->existing_image) {
                Storage::disk('public')->delete($this->existing_image);
            }
            $imagePath = $this->featured_image->store('blog', 'public');
        }

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt ?: null,
            'content' => $this->content,
            'featured_image' => $imagePath,
            'status' => $this->status,
            'published_at' => $this->published_at ? \Carbon\Carbon::parse($this->published_at) : null,
            'is_featured' => $this->is_featured,
            'allow_comments' => $this->allow_comments,
            'meta_title' => $this->meta_title ?: null,
            'meta_description' => $this->meta_description ?: null,
            'meta_keywords' => $this->meta_keywords ?: null,
        ];

        if ($this->post) {
            $this->post->update($data);
            $post = $this->post;
            Toast::success('Post updated successfully.');
        } else {
            $data['author_id'] = Auth::id();
            $post = BlogPost::create($data);
            Toast::success('Post created successfully.');
        }

        // Sync categories and tags
        $post->categories()->sync($this->selected_categories);
        $post->tags()->sync($this->selected_tags);

        return redirect()->route('admin.blog.posts.index');
    }

    public function removeImage()
    {
        if ($this->existing_image) {
            Storage::disk('public')->delete($this->existing_image);
            if ($this->post) {
                $this->post->update(['featured_image' => null]);
            }
            $this->existing_image = null;
        }
        $this->featured_image = null;
    }

    public function render()
    {
        $categories = BlogCategory::active()->orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();

        return view('admin.livewire.blog.posts.form', [
            'categories' => $categories,
            'tags' => $tags,
            'isEditing' => (bool) $this->post,
        ])->layout('admin.layouts.app')->title($this->isEditing ? __('blog.posts.edit') : __('blog.posts.create'));
    }
}
