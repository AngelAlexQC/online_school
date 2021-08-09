@php $editing = isset($admission) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="requester_id" label="Requester" required>
            @php $selected = old('requester_id', ($editing ? $admission->requester_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="malla_id" label="Malla" required>
            @php $selected = old('malla_id', ($editing ? $admission->malla_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Malla</option>
            @foreach($mallas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $admission->status : 'true')) @endphp
            <option value="true" {{ $selected == 'true' ? 'selected' : '' }} >Approved</option>
            <option value="false" {{ $selected == 'false' ? 'selected' : '' }} >No Approved</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
