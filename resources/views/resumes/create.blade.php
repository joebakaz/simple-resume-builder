<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Resume Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Profile Information') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update your account's profile information and email address.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('resumes.store') }}"  class="mt-6 space-y-6">
                            @csrf
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                            
                            <x-input-label for="about_me" :value="__('About Me')" />
                            <textarea name="about_me" id="about_me" class="mt-1 block w-full" required></textarea>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form> 
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    <section>
                        <header class="p-4 section-header">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Education Information') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __("Update your education here.") }}
                                </p>
                            </div>
                            <div class="icon-buttons">
                                <x-primary-button id="addEducationBtn" align="right" class="mt-1">{{ __('Add') }}</x-primary-button>
                            </div>
                        </header>

                        <div id="educationSection" class="p-4 ">
                            @include('resumes.partials.education_section', ['educations' => $educations])
                        </div>
                    </section>
                </div>
            </div>

            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    <section>
                        <header class="p-4 section-header">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Working Experience Information') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __("Update your working experience here.") }}
                                </p>
                            </div>
                            <div class="icon-buttons">
                                <x-primary-button id="addExperienceBtn" align="right" class="mt-1">{{ __('Add') }}</x-primary-button>
                            </div>
                        </header>
                        
                        <div id="experienceSection" class="p-4 ">
                            @include('resumes.partials.experience_section', ['expriences' => $experiences])
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    
    @include('resumes.partials.education_new_modal')
    @include('resumes.partials.experience_new_modal')

    {{-- TODO: Validation date time, logic start & end , UI design, and public View--}}
    <x-slot name="scripts">
        <script>
        </script>
    </x-slot>
        
</x-app-layout>