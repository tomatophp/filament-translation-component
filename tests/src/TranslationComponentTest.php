<?php

use Filament\Facades\Filament;
use Filament\Forms\Components\KeyValue;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;
use TomatoPHP\FilamentTranslationComponent\FilamentTranslationComponentServiceProvider;
use TomatoPHP\FilamentTranslationComponent\Tests\Livewire\TranslationForm;
use TomatoPHP\FilamentTranslationComponent\Tests\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('registers the service provider', function () {
    expect(app()->getProviders(FilamentTranslationComponentServiceProvider::class))->not->toBeEmpty();
});

it('merges the package config', function () {
    expect(config('filament-translation-component.languages'))
        ->toBeArray()
        ->toHaveKeys(['en', 'ar']);
});

it('loads the package translations and views', function () {
    expect(trans('filament-translation-component::messages.key'))
        ->not->toBe('filament-translation-component::messages.key')
        ->and(view()->exists('filament-translation-component::components.translation'))->toBeTrue();
});

it('boots the admin panel', function () {
    expect(Filament::getPanel('admin'))->not->toBeNull();
});

it('extends the key value component', function () {
    $component = Translation::make('title');

    expect($component)->toBeInstanceOf(KeyValue::class)
        ->and($component->getView())->toBe('filament-translation-component::components.translation');
});

it('returns an empty value for every configured language', function () {
    $locales = Translation::make('title')->getTranslatedLocales();

    expect($locales)->toBe(
        collect(config('filament-translation-component.languages'))->map(fn () => '')->toArray()
    );
});

it('keeps existing translations and fills the missing languages', function () {
    $locales = Translation::make('title')->getTranslatedLocales([
        'en' => 'Hello',
        'ar' => 'مرحبا',
        'fr' => 'Bonjour',
    ]);

    expect($locales)
        ->toHaveKeys(array_keys(config('filament-translation-component.languages')))
        ->not->toHaveKey('fr')
        ->and($locales['en'])->toBe('Hello')
        ->and($locales['ar'])->toBe('مرحبا')
        ->and($locales['pt_BR'])->toBe('');
});

it('can toggle the textarea mode', function () {
    expect(Translation::make('title')->isTextarea())->toBeFalse()
        ->and(Translation::make('title')->textarea()->isTextarea())->toBeTrue()
        ->and(Translation::make('title')->textarea(false)->isTextarea())->toBeFalse();
});

it('can set the languages list', function () {
    expect(Translation::make('title')->lang(['en', 'ar'])->getLang())->toBe(['en', 'ar']);
});

it('renders inside a filament form', function () {
    livewire(TranslationForm::class)
        ->assertSuccessful()
        ->assertSeeHtml('fi-fo-key-value')
        ->assertSeeHtml('<textarea', false);
});

it('fills the form with every configured language', function () {
    livewire(TranslationForm::class)
        ->call('save')
        ->assertSet('saved.title', collect(config('filament-translation-component.languages'))->map(fn () => '')->toArray());
});

it('saves the translated values', function () {
    livewire(TranslationForm::class)
        ->fillForm([
            'title' => ['en' => 'Hello', 'ar' => 'مرحبا'],
        ])
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('saved.title.en', 'Hello')
        ->assertSet('saved.title.ar', 'مرحبا');
});
