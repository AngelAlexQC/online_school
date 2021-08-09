<div>
    <div>
        @can('create', App\Models\AdmissionAtach::class)
        <button class="button" wire:click="newAdmissionAtach">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\AdmissionAtach::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full">
                        <x-inputs.partials.label
                            name="admissionAtachFile"
                            label="File"
                        ></x-inputs.partials.label
                        ><br />

                        <input
                            type="file"
                            name="admissionAtachFile"
                            id="admissionAtachFile{{ $uploadIteration }}"
                            wire:model="admissionAtachFile"
                            class="form-control-file"
                        />

                        @if($editing && $admissionAtach->file)
                        <div class="mt-2">
                            <a
                                href="{{ \Storage::url($admissionAtach->file) }}"
                                target="_blank"
                                ><i class="icon ion-md-download"></i
                                >&nbsp;Download</a
                            >
                        </div>
                        @endif @error('admissionAtachFile')
                        @include('components.inputs.partials.error') @enderror
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="admissionAtach.name"
                            label="Name"
                            wire:model="admissionAtach.name"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="admissionAtach.description"
                            label="Description"
                            wire:model="admissionAtach.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.admission_admission_ataches.inputs.file')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.admission_admission_ataches.inputs.name')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.admission_admission_ataches.inputs.description')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($admissionAtaches as $admissionAtach)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $admissionAtach->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        @if($admissionAtach->file)
                        <a
                            href="{{ \Storage::url($admissionAtach->file) }}"
                            target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $admissionAtach->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $admissionAtach->description ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $admissionAtach)
                            <button
                                type="button"
                                class="button"
                                wire:click="editAdmissionAtach({{ $admissionAtach->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="mt-10 px-4">
                            {{ $admissionAtaches->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
