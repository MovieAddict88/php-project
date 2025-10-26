<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson Plan Maker</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Lesson Plan Maker</h1>
            <div class="theme-switcher" id="theme-switcher">🌙</div>
        </div>
        <form id="lesson-plan-form" action="generate.php" method="post">
            <div class="form-group">
                <label for="template">Select Template:</label>
                <select id="template" name="template">
                    <option value="simple">Simple</option>
                    <option value="semi_detailed">Semi-Detailed</option>
                    <option value="detailed">Detailed</option>
                    <option value="deped">DepEd Format</option>
                </select>
            </div>
            <div class="form-group">
                <label for="teacher_name">Teacher's Name:</label>
                <input type="text" id="teacher_name" name="teacher_name" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="topic">Topic:</label>
                <input type="text" id="topic" name="topic" required>
            </div>
            <div id="common-fields">
                <div class="form-group">
                    <label for="objectives">Objectives:</label>
                    <textarea id="objectives" name="objectives" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="materials">Materials:</label>
                    <textarea id="materials" name="materials" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="procedure">Procedure:</label>
                    <textarea id="procedure" name="procedure" rows="8" required></textarea>
                </div>
                <div class="form-group">
                    <label for="evaluation">Evaluation:</label>
                    <textarea id="evaluation" name="evaluation" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="assignment">Assignment:</label>
                    <textarea id="assignment" name="assignment" rows="4"></textarea>
                </div>
            </div>
            <div id="detailed-fields" style="display: none;">
                <div class="form-group">
                    <label for="teacher_activity">Teacher's Activity:</label>
                    <textarea id="teacher_activity" name="teacher_activity" rows="8"></textarea>
                </div>
                <div class="form-group">
                    <label for="student_activity">Student's Activity:</label>
                    <textarea id="student_activity" name="student_activity" rows="8"></textarea>
                </div>
            </div>
            <div id="deped-fields" style="display: none;">
                <div class="form-group">
                    <label for="school_name">School Name:</label>
                    <input type="text" id="school_name" name="school_name">
                </div>
                <div class="form-group">
                    <label for="teaching_dates">Teaching Dates and Time:</label>
                    <input type="text" id="teaching_dates" name="teaching_dates">
                </div>
                <div class="form-group">
                    <label for="grade_level">Grade Level:</label>
                    <input type="text" id="grade_level" name="grade_level">
                </div>
                <div class="form-group">
                    <label for="quarter">Quarter:</label>
                    <input type="text" id="quarter" name="quarter">
                </div>
                 <div class="form-group">
                    <label for="content_standards">Content Standards:</label>
                    <textarea id="content_standards" name="content_standards" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="performance_standards">Performance Standards:</label>
                    <textarea id="performance_standards" name="performance_standards" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group button-group">
                <button type="submit" class="button button-primary">Generate PDF</button>
                <button type="button" id="save-button" class="button button-secondary">Save</button>
                <button type="button" id="load-button" class="button button-secondary">Load</button>
                <button type="button" id="reset-button" class="button button-secondary">Reset</button>
            </div>
        </form>
        <div id="loading-indicator">Generating PDF...</div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>