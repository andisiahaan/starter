<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;

class Index extends Component
{
    public string $section = 'general';

    protected $queryString = ['section'];

    public function mount()
    {
        $validSections = ['general', 'auth', 'socials', 'custom-tags', 'notifications', 'referral'];
        if (!in_array($this->section, $validSections)) {
            $this->section = 'general';
        }
    }

    public function setSection(string $section)
    {
        $this->section = $section;
    }

    public function render()
    {
        return view('admin.livewire.settings.index')
            ->layout('admin.layouts.app', ['title' => 'Settings']);
    }
}
