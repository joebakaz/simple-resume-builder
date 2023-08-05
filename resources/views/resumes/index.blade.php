<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your listing') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="d-flex justify-content-end mt-3 pb-3">
                <a href="{{ route('resumes.create') }}" class="shadow btn btn-primary">Create New Resume</a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6" id="resumeListingActionSection">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Public URL</th>
                            <th>Action</th>
                            <!-- Add more table headers as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resumes as $resume)
                            <tr>
                                <td>{{ $resume->title }}</td>
                                <td><a href="{{ route('resumes.public', $resume->public_url) }}">Public View</a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('resumes.edit', $resume->id) }}" class="btn-link me-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <form method="POST" id="resumeDelete{{$resume->id}}" action="{{ route('resumes.destroy', $resume->id) }}" >
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-link text-danger resume-delete-icon" data-id="{{ $resume->id }}" data-type="resume">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $resumes->links() }} <!-- Render pagination links -->
            </div>
        </div>
    </div>
    
    <x-slot name="scripts">
    </x-slot>
</x-app-layout>