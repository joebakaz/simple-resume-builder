<div class="modal fade" id="educationModal" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('education.store') }}" id="educationForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="educationModalLabel">Add Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="py-12">
                        
                            @csrf
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden sm:rounded-lg">
                                    <x-input-label for="school" :value="__('School')" />
                                    <x-text-input id="school" name="school" type="text" class="mt-1 block w-full" required autofocus autocomplete="school" />

                                    <div class="mb-3 pt-3">
                                        <x-select id="degree" name="degree">
                                            Degree
                                            <x-slot name="options" :value="old('degree', $education->degree ?? '')">
                                                <option value="Diploma">Diploma</option>
                                                <option value="Bachelor Degree">Bachelor Degree</option>
                                                <option value="Master">Master</option>
                                                <option value="PhD">PhD</option>
                                            </x-slot>
                                        </x-select>
                                    </div>

                                    <x-input-label for="graduation_year" :value="__('Graduation Year')" />
                                    <x-text-input id="graduation_year" name="graduation_year" type="text" class="mt-1 block w-full" required autofocus autocomplete="graduation_year" min="{{ date('Y') - 50  }}" max="{{ date('Y')}}" graduation_year_not_greater/>
                                    
                                    <x-input-label for="faculty" :value="__('Faculty')" />
                                    <x-text-input id="faculty" name="faculty" type="text" class="mt-1 block w-full" required autofocus autocomplete="faculty" />
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-primary-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</x-primary-button>
                    <x-primary-button type="submit" id="submitEducation">{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>