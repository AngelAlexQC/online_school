@php $editing = isset($matter) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $matter->name : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="credits"
            label="Credits"
            value="{{ old('credits', ($editing ? $matter->credits : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="level_id" label="Level" required>
            @php $selected = old('level_id', ($editing ? $matter->level_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Level</option>
            @foreach($levels as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
