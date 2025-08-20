<?php

namespace TomatoPHP\FilamentTranslationComponent\Components;

use Filament\Forms\Components\KeyValue;

class Translation extends KeyValue
{
    protected string $view = 'filament-translation-component::components.translation';

    public array $lang = [];

    public bool $textarea = false;

    protected function setUp(): void
    {
        $this->keyLabel(trans('filament-translation-component::messages.key'));
        $this->valueLabel(trans('filament-translation-component::messages.value'));
        $this->editableKeys(false);
        $this->addable(false);
        $this->deletable(false);
    }

    public function textarea(bool $value = true): static
    {
        $this->textarea = $value;

        return $this;
    }

    public function isTextarea(): bool
    {
        return $this->textarea;
    }
}
