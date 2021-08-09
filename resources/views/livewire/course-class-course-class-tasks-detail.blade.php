<div>
    <div>
        @can('create', App\Models\CourseClassTask::class)
        <button class="button" wire:click="newCourseClassTask">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\CourseClassTask::class)
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
                        <x-inputs.text
                            name="courseClassTask.name"
                            label="Name"
                            wire:model="courseClassTask.name"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.textarea
                            name="courseClassTask.content"
                            label="Content"
                            wire:model="courseClassTask.content"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.partials.label
                            name="courseClassTaskFile"
                            label="File"
                        ></x-inputs.partials.label
                        ><br />

                        <input
                            type="file"
                            name="courseClassTaskFile"
                            id="courseClassTaskFile{{ $uploadIteration }}"
                            wire:model="courseClassTaskFile"
                            class="form-control-file"
                        />

                        @if($editing && $courseClassTask->file)
                        <div class="mt-2">
                            <a
                                href="{{ \Storage::url($courseClassTask->file) }}"
                                target="_blank"
                                ><i class="icon ion-md-download"></i
                                >&nbsp;Download</a
                            >
                        </div>
                        @endif @error('courseClassTaskFile')
                        @include('components.inputs.partials.error') @enderror
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="courseClassTask.score"
                            label="Score"
                            wire:model="courseClassTask.score"
                            max="255"
                        ></x-inputs.number>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @can('view-any', App\Models\StudentTask::class)
            <x-partials.card class="mt-5 shadow-none bg-gray-50">
                <h4 class="text-sm text-gray-600 font-bold mb-3">
                    Student Tasks
                </h4>

                <livewire:course-class-task-student-tasks-detail
                    :courseClassTask="$courseClassTask"
                />
            </x-partials.card>
            @endcan @endif
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
                        @lang('crud.course_class_course_class_tasks.inputs.name')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.course_class_course_class_tasks.inputs.content')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.course_class_course_class_tasks.inputs.file')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.course_class_course_class_tasks.inputs.score')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($courseClassTasks as $courseClassTask)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $courseClassTask->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $courseClassTask->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $courseClassTask->content ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        @if($courseClassTask->file)
                        <a
                            href="{{ \Storage::url($courseClassTask->file) }}"
                            target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $courseClassTask->score ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $courseClassTask)
                            <button
                                type="button"
                                class="button"
                                wire:click="editCourseClassTask({{ $courseClassTask->id }})"
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
                    <td colspan="5">
                        <div class="mt-10 px-4">
                            {{ $courseClassTasks->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
