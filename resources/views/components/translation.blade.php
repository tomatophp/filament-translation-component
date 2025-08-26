@php
    $fieldWrapperView = $getFieldWrapperView();
    $extraAttributeBag = $getExtraAttributeBag();
    $canEditKeys = $canEditKeys();
    $canEditValues = $canEditValues();
    $keyPlaceholder = $getKeyPlaceholder();
    $valuePlaceholder = $getValuePlaceholder();
    $debounce = $getLiveDebounce();
    $hasInlineLabel = $hasInlineLabel();
    $isAddable = $isAddable();
    $isDeletable = $isDeletable();
    $isDisabled = $isDisabled();
    $isReorderable = $isReorderable();
    $statePath = $getStatePath();
    $livewireKey = $getLivewireKey();

    $textarea = $isTextarea();
@endphp

<x-dynamic-component
    :component="$fieldWrapperView"
    :field="$field"
    :has-inline-label="$hasInlineLabel"
    class="fi-fo-key-value-wrp"
>
    <x-filament::input.wrapper
        :disabled="$isDisabled"
        :valid="! $errors->has($statePath)"
        :attributes="
            \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
                ->class(['fi-fo-key-value'])
        "
    >
        <div
            x-load
            x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('key-value', 'filament/forms') }}"
            x-data="keyValueFormComponent({
                        state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')") }},
                    })"
            wire:ignore
            wire:key="{{ $livewireKey }}.{{
                substr(md5(serialize([
                    $isDisabled,
                ])), 0, 64)
            }}"
            {{
                $attributes
                    ->merge($getExtraAlpineAttributes(), escape: false)
                    ->class(['fi-fo-key-value-table-ctn'])
            }}
        >
            <table class="fi-fo-key-value-table">
                <thead>
                    <tr>
                        @if ($isReorderable && (! $isDisabled))
                            <th
                                scope="col"
                                x-show="rows.length"
                                class="fi-has-action"
                            ></th>
                        @endif

                        <th scope="col">
                            {{ $getKeyLabel() }}
                        </th>

                        <th scope="col">
                            {{ $getValueLabel() }}
                        </th>

                        @if ($isDeletable && (! $isDisabled))
                            <th
                                scope="col"
                                x-show="rows.length"
                                class="fi-has-action"
                            ></th>
                        @endif
                    </tr>
                </thead>

                <tbody
                    @if ($isReorderable)
                        x-on:end.stop="reorderRows($event)"
                        x-sortable
                        data-sortable-animation-duration="{{ $getReorderAnimationDuration() }}"
                    @endif
                >
                    <template
                        x-bind:key="index"
                        x-for="(row, index) in rows"
                    >
                        <tr
                            @if ($isReorderable)
                                x-bind:x-sortable-item="row.key"
                            @endif
                        >
                            @if ($isReorderable && (! $isDisabled))
                                <td class="fi-has-action">
                                    <div
                                        x-sortable-handle
                                        class="fi-fo-key-value-table-row-sortable-handle"
                                    >
                                        {{ $getAction('reorder') }}
                                    </div>
                                </td>
                            @endif

                            <td>
                                @php
                                    $langLabels = [];
                                    foreach (config('filament-translation-component.languages') as $key=>$langItem){
                                        $langLabels[$key] = [
                                            'label' => trans('filament-translation-component::messages.'.$key),
                                            'flag' => $langItem['flag']
                                        ];
                                    }
                                @endphp
                                <div x-data="{lang: '{{ json_encode($langLabels) }}'}" class="fi-sidebar-group-btn" style="padding-left: 16px; padding-right: 16px;">
                                    <div class="flex flex-col justify-center items-center">
                                        <x-filament::avatar x-bind:src="'https://cdn.jsdelivr.net/gh/hampusborgos/country-flags@main/svg/'+JSON.parse(lang)[row.key].flag+'.svg'" :circular="false" size="sm" />
                                    </div>
                                    <div class="font-xs">
                                        <b x-html="JSON.parse(lang)[row.key].label"></b>
                                    </div>
                                </div>
                            </td>

                            <td class="border">
                                @if($textarea)
                                <textarea
                                    @disabled((! $canEditValues) || $isDisabled)
                                    placeholder="{{ $valuePlaceholder }}"
                                    type="text"
                                    x-model="row.value"
                                    x-on:input.debounce.{{ $debounce ?? '500ms' }}="updateState"
                                    class="fi-input"
                                    style="resize: none; width: 100%; padding-top: 5px;padding-bottom: 5px;padding-left: 16px; padding-right: 16px; outline: none; border: none; height: auto;"
                                    rows="3"
                                ></textarea>
                                @else
                                <input
                                    @disabled((! $canEditValues) || $isDisabled)
                                    placeholder="{{ $valuePlaceholder }}"
                                    type="text"
                                    x-model="row.value"
                                    x-on:input.debounce.{{ $debounce ?? '500ms' }}="updateState"
                                    class="fi-input"
                                />
                                @endif
                            </td>

                            @if ($isDeletable && (! $isDisabled))
                                <td class="fi-has-action">
                                    <div x-on:click="deleteRow(index)">
                                        {{ $getAction('delete') }}
                                    </div>
                                </td>
                            @endif
                        </tr>
                    </template>
                </tbody>
            </table>

            @if ($isAddable && (! $isDisabled))
                <div
                    x-on:click="addRow"
                    class="fi-fo-key-value-add-action-ctn"
                >
                    {{ $getAction('add') }}
                </div>
            @endif
        </div>
    </x-filament::input.wrapper>
</x-dynamic-component>
