<!-- education_section.blade.php -->
@foreach($educations as $education)
    <div class="card education-card">
        <div class="card-body">
            <div>
                <h4 class="card-title">{{ $education->school }}</h4>
                <p class="card-text">{{ $education->degree }}</p>
                <p class="card-text">{{ $education->graduation_year }}</p>
                <p class="card-text">{{ $education->faculty }}</p>
            </div>
            <div class="icon-buttons">
                <a href="#" class="btn edu-edit-icon" data-id="{{ $education->id }}">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="#" class="btn btn-link text-danger edu-delete-icon" data-id="{{ $education->id }}" data-type="education">
                    <i class="bi bi-trash"></i>
                </a>
            </div>
        </div>
    </div>
@endforeach