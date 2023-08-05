<div>
    <label for="{{ $attributes['id'] }}" class="block font-medium text-gray-700">{{ $slot }}</label>
    <select {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full']) }}>
        <option value="" disabled>Select {{ strtolower($slot) }}</option>
        {{ $options }}
    </select>
</div>