<!-- education_section.blade.php -->
@foreach($experiences as $experience)
<div class="card education-card">
    <div class="card-body">
        <div>
            <div class="item">
                <div class="meta">
                    <div class="upper-row text-base">
                        <h3 class="job-title">
                            {{ $experience->job_title }}
                        </h3>
                        <div class="time text-xs">
                            {{ $experience->start_date }}
                            -
                            {{ isset($experience->end_date) ? $experience->end_date : 'Present' }}
                        </div>
                    </div>
                    <div class="company">
                        {{ $experience->company }}
                    </div>
                </div>
                <div class="details">
                    <p>{!! !empty($experience->job_description) ?  nl2br(e($experience->job_description)) : '' !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="icon-buttons">
            <a href="#" class="btn exp-edit-icon" data-id="{{ $experience->id }}">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <a href="#" class="btn btn-link text-danger exp-delete-icon" data-id="{{ $experience->id }}" data-type="experience">
                <i class="bi bi-trash"></i>
            </a>
        </div>
    </div>
</div>
@endforeach