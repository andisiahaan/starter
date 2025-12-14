<?php

namespace App\Livewire\Admin\HelpArticles;

use App\Helpers\Toast;
use App\Models\HelpArticle;
use App\Models\HelpCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public ?HelpArticle $article = null;
    
    // Form fields
    public string $title = '';
    public string $slug = '';
    public ?int $help_category_id = null;
    public string $content = '';
    public bool $is_active = true;
    public ?string $published_at = null;
    public int $order_column = 0;
    public string $meta_title = '';
    public string $meta_description = '';

    public function mount(?HelpArticle $article = null)
    {
        if ($article && $article->exists) {
            $this->article = $article;
            $this->title = $article->title;
            $this->slug = $article->slug;
            $this->help_category_id = $article->help_category_id;
            $this->content = $article->content;
            $this->is_active = $article->is_active;
            $this->published_at = $article->published_at?->format('Y-m-d\TH:i');
            $this->order_column = $article->order_column;
            $this->meta_title = $article->meta_title ?? '';
            $this->meta_description = $article->meta_description ?? '';
        } else {
            // Set default values for new article
            $this->published_at = now()->format('Y-m-d\TH:i');
        }
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:help_articles,slug,' . ($this->article?->id),
            'help_category_id' => 'required|exists:help_categories,id',
            'content' => 'required|string',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
            'order_column' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
        ];

        $this->validate($rules);

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'help_category_id' => $this->help_category_id,
            'content' => $this->content,
            'is_active' => $this->is_active,
            'published_at' => $this->published_at ? Carbon::parse($this->published_at) : null,
            'order_column' => $this->order_column,
            'meta_title' => $this->meta_title ?: null,
            'meta_description' => $this->meta_description ?: null,
        ];

        if ($this->article) {
            $this->article->update($data);
            Toast::success(__('help.admin.articles.messages.updated'));
        } else {
            HelpArticle::create($data);
            Toast::success(__('help.admin.articles.messages.created'));
        }

        return redirect()->route('admin.help-articles.index');
    }

    public function render()
    {
        $categories = HelpCategory::active()->ordered()->get();

        return view('admin.livewire.help-articles.form', [
            'categories' => $categories,
            'isEditing' => (bool) $this->article?->exists,
        ])->layout('admin.layouts.app', [
            'title' => __('help.admin.articles.create'),
            ]);
    }
}
