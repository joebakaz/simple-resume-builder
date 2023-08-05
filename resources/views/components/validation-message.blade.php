@if($errors->has($name))
    <p class="text-red-500 text-sm mt-1">{{ $errors->first($name) }}</p>
@endif