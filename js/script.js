document.addEventListener('DOMContentLoaded', function() {
    var templateSelect = document.getElementById('template');
    var commonFields = document.getElementById('common-fields');
    var detailedFields = document.getElementById('detailed-fields');
    var depedFields = document.getElementById('deped-fields');

    templateSelect.addEventListener('change', function() {
        // Hide all template-specific fields
        detailedFields.style.display = 'none';
        depedFields.style.display = 'none';

        // Hide procedure for detailed
        var procedure = commonFields.querySelector('#procedure').parentNode;
        procedure.style.display = 'block';

        if (this.value === 'detailed') {
            detailedFields.style.display = 'block';
            procedure.style.display = 'none';
        } else if (this.value === 'deped') {
            depedFields.style.display = 'block';
        }
    });

    document.getElementById('lesson-plan-form').addEventListener('submit', function(event) {
        var template = templateSelect.value;
        var requiredFields = ['teacher_name', 'subject', 'topic', 'objectives', 'materials', 'evaluation'];

        if (template === 'detailed') {
            requiredFields.push('teacher_activity', 'student_activity');
        } else {
            requiredFields.push('procedure');
        }

        if (template === 'deped') {
            requiredFields.push('school_name', 'teaching_dates', 'grade_level', 'quarter', 'content_standards', 'performance_standards');
        }


        var emptyFields = [];

        requiredFields.forEach(function(field) {
            var input = document.getElementById(field);
            if (input && input.value.trim() === '') {
                emptyFields.push(field.replace(/_/g, ' '));
            }
        });

        if (emptyFields.length > 0) {
            event.preventDefault();
            alert('Please fill out all required fields: ' + emptyFields.join(', '));
        }
    });
});