<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.course_classes.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('course-classes.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <x-form
                    method="PUT"
                    action="{{ route('course-classes.update', $courseClass) }}"
                    class="mt-4"
                >
                    @include('app.course_classes.form-inputs')

                    <div class="mt-10">
                        <a
                            href="{{ route('course-classes.index') }}"
                            class="button"
                        >
                            <i
                                class="mr-1 icon ion-md-return-left text-primary"
                            ></i>
                            @lang('crud.common.back')
                        </a>

                        <a
                            href="{{ route('course-classes.create') }}"
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

            @can('view-any', App\Models\Assistances::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> All Assistances </x-slot>

                <livewire:course-class-all-assistances-detail
                    :courseClass="$courseClass"
                />
            </x-partials.card>
            @endcan @can('view-any', App\Models\ClassComment::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Class Comments </x-slot>

                <livewire:course-class-class-comments-detail
                    :courseClass="$courseClass"
                />
            </x-partials.card>
            @endcan @can('view-any', App\Models\CourseClassTask::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Course Class Tasks </x-slot>

                <livewire:course-class-course-class-tasks-detail
                    :courseClass="$courseClass"
                />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
