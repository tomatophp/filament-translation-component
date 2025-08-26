<?php

namespace TomatoPHP\FilamentTranslationComponent\Components;

use Illuminate\Support\Arr;
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
        $this->formatStateUsing(fn($state) => $this->getTranslatedLocales($state));
        $this->default(fn () => $this->getTranslatedLocales());
    }

    public function getTranslatedLocales($state = null): array
    {
        if($state) {
            return collect(config('filament-translation-component.languages'))->mapWithKeys(function ($item, $key) use ($state) {
                if(collect($state)->has($key)) {
                    return [$key => collect($state)->get($key)];
                }
                return [$key => ''];
            })->toArray();
        }
        else {
            return collect(config('filament-translation-component.languages'))->mapWithKeys(function ($item, $key) {
                return [$key => ''];
            })->toArray();
        }

    }

    public function lang(array $lang): static
    {
        $this->lang = $lang;

        return $this;
    }

    public function getLang(): array
    {
        return $this->lang;
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
