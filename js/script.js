document.addEventListener('DOMContentLoaded', function() {
    var templateSelect = document.getElementById('template');
    var commonFields = document.getElementById('common-fields');
    var detailedFields = document.getElementById('detailed-fields');
    var depedFields = document.getElementById('deped-fields');
    var themeSwitcher = document.getElementById('theme-switcher');
    var form = document.getElementById('lesson-plan-form');
    var loadingIndicator = document.getElementById('loading-indicator');
    var saveButton = document.getElementById('save-button');
    var loadButton = document.getElementById('load-button');
    var resetButton = document.getElementById('reset-button');
    var notification = document.getElementById('notification');
    var errorMessage = document.createElement('div');
    errorMessage.id = 'error-message';
    errorMessage.style.display = 'none';
    form.insertBefore(errorMessage, form.firstChild);

    function showNotification(message, type = 'success') {
        notification.textContent = message;
        notification.className = 'show ' + type;
        setTimeout(function() {
            notification.className = notification.className.replace('show', '');
        }, 3000);
    }

    // Initialize TinyMCE
    function initTinyMCE(theme) {
        tinymce.init({
            selector: 'textarea',
            plugins: 'lists link table',
            toolbar: 'undo redo | bold italic | bullist numlist | link table',
            skin: (theme === 'dark') ? 'oxide-dark' : 'oxide',
            content_css: (theme === 'dark') ? 'dark' : 'default'
        });
    }

    initTinyMCE(document.documentElement.getAttribute('data-theme'));

    // Theme switcher
    themeSwitcher.addEventListener('click', function() {
        var currentTheme = document.documentElement.getAttribute('data-theme');
        if (currentTheme === 'dark') {
            document.documentElement.removeAttribute('data-theme');
            themeSwitcher.textContent = '🌙';
            tinymce.remove();
            initTinyMCE('light');
        } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            themeSwitcher.textContent = '☀️';
            tinymce.remove();
            initTinyMCE('dark');
        }
    });

    // Template visibility
    templateSelect.addEventListener('change', function() {
        detailedFields.style.display = 'none';
        depedFields.style.display = 'none';

        var procedure = commonFields.querySelector('#procedure').parentNode;
        procedure.style.display = 'block';

        if (this.value === 'detailed') {
            detailedFields.style.display = 'block';
            procedure.style.display = 'none';
        } else if (this.value === 'deped') {
            depedFields.style.display = 'block';
        }
    });

    // Save and Load functionality
    saveButton.addEventListener('click', function() {
        tinymce.triggerSave();
        var formData = new FormData(form);
        var data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        localStorage.setItem('lessonPlanData', JSON.stringify(data));
        showNotification('Lesson plan saved successfully!');
    });

    loadButton.addEventListener('click', function() {
        var data = JSON.parse(localStorage.getItem('lessonPlanData'));
        if (data) {
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    var element = document.getElementById(key);
                    if (element) {
                        element.value = data[key];
                        if (element.tagName.toLowerCase() === 'textarea') {
                            tinymce.get(key).setContent(data[key]);
                        }
                    }
                }
            }
            templateSelect.dispatchEvent(new Event('change'));
            showNotification('Lesson plan loaded successfully!');
        } else {
            showNotification('No saved data found.', 'error');
        }
    });

    // Reset functionality
    resetButton.addEventListener('click', function() {
        form.reset();
        for (var i = 0; i < tinymce.editors.length; i++) {
            tinymce.editors[i].setContent('');
        }
        templateSelect.dispatchEvent(new Event('change'));
        showNotification('Form cleared successfully!');
    });

    // Form validation and loading indicator
    form.addEventListener('submit', function(event) {
        tinymce.triggerSave();
        errorMessage.style.display = 'none';
        errorMessage.innerHTML = '';

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
            errorMessage.innerHTML = 'Please fill out all required fields: ' + emptyFields.join(', ') + '<span class="close-btn">&times;</span>';
            errorMessage.style.display = 'block';

            errorMessage.querySelector('.close-btn').addEventListener('click', function() {
                errorMessage.style.display = 'none';
            });
        } else {
            loadingIndicator.style.display = 'block';
        }
    });
});
