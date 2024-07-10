<?php

namespace TomatoPHP\FilamentTranslationComponent\Components;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;

class Translation extends KeyValue
{
    protected string $view = 'filament-translation-component::components.translation';

    public array $lang = [];


    protected function setUp(): void
    {
        $lang = [];
        foreach (config('filament-translation-component.languages') as $key=>$local){
            $lang[] = TextInput::make($key)
                ->placeholder(trans('filament-translation-component::messages.'.$key))
                ->required($this->isRequired());
        }
        $this->keyLabel(trans('filament-translation-component::messages.key'));
        $this->valueLabel(trans('filament-translation-component::messages.value'));
        $this->editableKeys(false);
        $this->addable(false);
        $this->deletable(false);
        $this->schema($lang);
    }
}
