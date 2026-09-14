<?php

namespace TomatoPHP\FilamentTranslationComponent\Tests\Livewire;

use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;

class TranslationForm extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Translation::make('title'),
                Translation::make('description')->textarea(),
            ])
            ->statePath('data');
    }

    public array $saved = [];

    public function save(): void
    {
        $this->saved = $this->form->getState();
    }

    public function render(): View
    {
        return view('translation-form');
    }
}
