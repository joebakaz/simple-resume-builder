<div class="modal fade" id="experienceModal" tabindex="-1" aria-labelledby="experienceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('experience.store') }}" id="experienceForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="experienceModalLabel">Add Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        @csrf
                        <x-input-label for="company" :value="__('Company')" />
                        <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" required autofocus autocomplete="company" />

                        
                        <x-input-label for="job_title" :value="__('Job Title')" />
                        <x-text-input id="job_title" name="job_title" type="text" class="mt-1 block w-full" required autofocus autocomplete="job_title" />

                        
                        <div class="mb-3">
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <input type="date" id="start_date" class="form-control" name="start_date" :value="old('start_date', optional($experience->start_date)->format('Y-m-d'))" required />
                            <x-validation-message name="start_date" />
                        </div>
                        
                        <div class="mb-3">
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <input type="date" id="end_date" class="form-control" name="end_date" :value="old('end_date', optional($experience->end_date)->format('Y-m-d'))" />
                            <x-validation-message name="end_date" />
                        </div>
                       @error('end_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <x-input-label for="job_description" :value="__('Job Description')" />
                        <textarea name="job_description" id="job_description" class="mt-1 block w-full" required></textarea>
                    
                </div>
                <div class="modal-footer">
                    <x-primary-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</x-primary-button>
                    <x-primary-button type="submit" id="submitExperience">{{ __('Save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>