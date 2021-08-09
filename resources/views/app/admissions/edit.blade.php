<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.admissions.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('admissions.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <x-form
                    method="PUT"
                    action="{{ route('admissions.update', $admission) }}"
                    class="mt-4"
                >
                    @include('app.admissions.form-inputs')

                    <div class="mt-10">
                        <a
                            href="{{ route('admissions.index') }}"
                            class="button"
                        >
                            <i
                                class="mr-1 icon ion-md-return-left text-primary"
                            ></i>
                            @lang('crud.common.back')
                        </a>

                        <a
                            href="{{ route('admissions.create') }}"
                            class="button"
                        >
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>

            @can('view-any', App\Models\AdmissionAtach::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Admission Ataches </x-slot>

                <livewire:admission-admission-ataches-detail
                    :admission="$admission"
                />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>