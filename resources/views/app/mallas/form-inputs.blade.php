@php $editing = isset($malla) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $malla->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="year"
            label="Year"
            value="{{ old('year', ($editing ? $malla->year : '')) }}"
            max="255"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="career_id" label="Career" required>
            @php $selected = old('career_id', ($editing ? $malla->career_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Career</option>
            @foreach($careers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
