import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function () {
    var eduModal = $('#educationModal');
    var expModal = $('#experienceModal');
    var formEdu = eduModal.find('form');
    var formExp = expModal.find('form');
    var educationContainer = $('#educationSection');
    var experienceContainer = $('#experienceSection');
    var resumeActionContainer = $('#resumeListingActionSection');

    $('#addEducationBtn').click(() => openModal(formEdu, eduModal, 'education'));
    $('#addExperienceBtn').click(() => openModal(formExp, expModal, 'experience'));

    formEdu.submit((e) => handleSubmitForm(e, formEdu, educationContainer, 'education'));
    formExp.submit((e) => handleSubmitForm(e, formExp, experienceContainer, 'experience'));

    educationContainer.on('click', '.edu-edit-icon', (e) => handleEditIconClick(e, formEdu, eduModal, 'education'));
    experienceContainer.on('click', '.exp-edit-icon', (e) => handleEditIconClick(e, formExp, expModal, 'experience'));

    educationContainer.on('click', '.edu-delete-icon', function () {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this entry?')) {
            deleteEntry(id, 'education', educationContainer);
        }
    });

    experienceContainer.on('click', '.exp-delete-icon', function () {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this entry?')) {
            deleteEntry(id, 'experience', experienceContainer);
        }
    });

    resumeActionContainer.on('click', '.resume-delete-icon', function () {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this entry?')) {
            var formId = '#resumeDelete'+id;
            $( formId ).trigger( "submit" );
        }
    });

    function openModal(form, modal, type) {
        form.trigger('reset');
        populateModalWithData(null, form, type);
        modal.modal('show');
    }

    function handleSubmitForm(e, form, container, type) {
        e.preventDefault();
        submitForm(form, form.data('id') ? 'PUT' : 'POST', container, type);
    }

    function handleEditIconClick(e, form, modal, type) {
        e.preventDefault();
        const icon = $(e.currentTarget);
        const id = icon.data('id');
        const data = type === 'education' ? getEduDataForEdit(id) : getExpDataForEdit(id);

        form.data('id', id);
        populateModalWithData(data, form, type);
        modal.modal('show');
    }

    function getEduDataForEdit(id) {
        var data = {};
        $.ajax({
            url: '/education/' + id,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function(response) {
                data = response.education;
            }
        });
        return data;
    }

    function getExpDataForEdit(id) {
        var data = {};
            $.ajax({
                url: '/experience/' + id,
                type: 'GET',
                dataType: 'json',
                async: false,
                success: function(response) {
                    data = response.experience;
                }
            });
            return data;
    }

    function populateModalWithData(data,form, type) {
        if(data !== null){
                
            if (type === 'education') {
                $('#educationModalLabel').text('Edit Educations');
                form.find('[name="school"]').val(data.school);
                form.find('[name="degree"]').val(data.degree);
                form.find('[name="graduation_year"]').val(data.graduation_year);
                form.find('[name="faculty"]').val(data.faculty);

            } else if (type === 'experience') {
                $('#experienceModalLabel').text('Edit Working Experiences');
                form.find('[name="company"]').val(data.company);
                form.find('[name="job_title"]').val(data.job_title);
                form.find('[name="start_date"]').val(data.start_date);
                form.find('[name="end_date"]').val(data.end_date);
                form.find('[name="job_description"]').val(data.job_description);
            }
        }else{
            if (type === 'education') {
                $('#educationModalLabel').text('Add Educations');
            } else if (type === 'experience') {
                $('#experienceModalLabel').text('Add Working Experiences');
            }
            form.data('id', null);
        }
        
        const actionUrl = data !== null ? `/${type}/${data.id}` : `/${type}`;
        form.attr('action', actionUrl);
    }

    function submitForm(form, method, container, type) {
        const formData = form.serialize();
        const url = form.attr('action');
        $.ajax({
            url: url,
            type: method,
            data: formData,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'json',
            success: (response) => closeModalAndRefresh(response, container, type),
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    displayValidationErrors(errors, type);
                }
            }
        });
    }

    function closeModalAndRefresh(response, container, type) {
        var modal;
        if (type === 'education') {
            modal = $('#educationModal');
        } else if (type === 'experience') {
            modal = $('#experienceModal');
        }
        modal.modal('hide');
        container.html(response[type + 'Section']);
    }

    function displayValidationErrors(errors, sectionType) {
        var modalSelector = sectionType === 'education' ? '#educationModal' : '#experienceModal';
        var modal = $(modalSelector);
        modal.find('.text-danger').remove();
    
        $.each(errors, function(field, messages) {
            var input = modal.find('[name="' + field + '"]');
            var errorContainer = $('<span class="text-danger">' + messages[0] + '</span>');
            input.after(errorContainer);
        });
    }

    function deleteEntry(id, type, container) {
        $.ajax({
            url: '/' + type + '/' + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                closeModalAndRefresh(response, container, type);
            },
            error: function(error) {
            }
        });
    }
});