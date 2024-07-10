<?php

namespace TomatoPHP\FilamentTranslationComponent\Components;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;

class Translation extends KeyValue
{
    protected array $lang = [];
    protected function setUp(): void
    {
        $lang = [];
        $getLang = count($this->lang) > 0 ? $this->lang : config('filament-translation-component.languages');
        foreach ($getLang as $key=>$local){
            $lang[] = TextInput::make($key)
                ->label(trans('filament-translation-component::messages.'.$key))
                ->required($this->isRequired());
        }
        $this->keyLabel('language');
        $this->editableKeys(false);
        $this->addable(false);
        $this->deletable(false);
        $this->schema($lang);
    }

    public function languages(array $lang=[]): static
    {
        foreach ($lang as $item){
            $this->lang[$item] = $item;
        }
        return $this;
    }
}
