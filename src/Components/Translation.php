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
        parent::setUp();

        $this->keyLabel(trans('filament-translation-component::messages.key'));
        $this->valueLabel(trans('filament-translation-component::messages.value'));
        $this->editableKeys(false);
        $this->addable(false);
        $this->deletable(false);
        $this->formatStateUsing(fn (mixed $state): array => $this->getTranslatedLocales($state));
        $this->default(fn (): array => $this->getTranslatedLocales());
    }

    public function getTranslatedLocales(mixed $state = null): array
    {
        $languages = collect(config('filament-translation-component.languages'));

        if (! $state) {
            return $languages->mapWithKeys(fn (mixed $item, string $key): array => [$key => ''])->toArray();
        }

        $state = collect($state);

        return $languages->mapWithKeys(
            fn (mixed $item, string $key): array => [$key => $state->has($key) ? $state->get($key) : '']
        )->toArray();
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
