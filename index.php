<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old_input = isset($_SESSION['old_input']) ? $_SESSION['old_input'] : [];
unset($_SESSION['errors']);
unset($_SESSION['old_input']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson Plan Maker</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/config.js"></script>
    <script>
        document.write('<script src="https://cdn.tiny.cloud/1/' + (typeof TINYMCE_API_KEY !== 'undefined' ? TINYMCE_API_KEY : 'no-api-key') + '/tinymce/8/tinymce.min.js" referrerpolicy="origin"><\/script>');
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Lesson Plan Maker</h1>
            <div class="theme-switcher" id="theme-switcher">🌙</div>
        </div>
        <?php if (!empty($errors)): ?>
            <div id="error-message">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
                <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        <?php endif; ?>
        <form id="lesson-plan-form" action="generate.php" method="post">
            <div class="form-group">
                <label for="template">Select Template:</label>
                <select id="template" name="template">
                    <option value="simple" <?php echo (isset($old_input['template']) && $old_input['template'] === 'simple') ? 'selected' : ''; ?>>Simple</option>
                    <option value="semi_detailed" <?php echo (isset($old_input['template']) && $old_input['template'] === 'semi_detailed') ? 'selected' : ''; ?>>Semi-Detailed</option>
                    <option value="detailed" <?php echo (isset($old_input['template']) && $old_input['template'] === 'detailed') ? 'selected' : ''; ?>>Detailed</option>
                    <option value="deped" <?php echo (isset($old_input['template']) && $old_input['template'] === 'deped') ? 'selected' : ''; ?>>DepEd Format</option>
                </select>
            </div>
            <div class="form-group">
                <label for="teacher_name">Teacher's Name:</label>
                <input type="text" id="teacher_name" name="teacher_name" value="<?php echo isset($old_input['teacher_name']) ? htmlspecialchars($old_input['teacher_name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" value="<?php echo isset($old_input['subject']) ? htmlspecialchars($old_input['subject']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="topic">Topic:</label>
                <input type="text" id="topic" name="topic" value="<?php echo isset($old_input['topic']) ? htmlspecialchars($old_input['topic']) : ''; ?>" required>
            </div>
            <div id="common-fields">
                <div class="form-group">
                    <label for="objectives">Objectives:</label>
                    <textarea id="objectives" name="objectives" rows="4" required><?php echo isset($old_input['objectives']) ? htmlspecialchars($old_input['objectives']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="materials">Materials:</label>
                    <textarea id="materials" name="materials" rows="4" required><?php echo isset($old_input['materials']) ? htmlspecialchars($old_input['materials']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="procedure">Procedure:</label>
                    <textarea id="procedure" name="procedure" rows="8" required><?php echo isset($old_input['procedure']) ? htmlspecialchars($old_input['procedure']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="evaluation">Evaluation:</label>
                    <textarea id="evaluation" name="evaluation" rows="4" required><?php echo isset($old_input['evaluation']) ? htmlspecialchars($old_input['evaluation']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="assignment">Assignment:</label>
                    <textarea id="assignment" name="assignment" rows="4"><?php echo isset($old_input['assignment']) ? htmlspecialchars($old_input['assignment']) : ''; ?></textarea>
                </div>
            </div>
            <div id="detailed-fields" style="display: none;">
                <div class="form-group">
                    <label for="teacher_activity">Teacher's Activity:</label>
                    <textarea id="teacher_activity" name="teacher_activity" rows="8"><?php echo isset($old_input['teacher_activity']) ? htmlspecialchars($old_input['teacher_activity']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="student_activity">Student's Activity:</label>
                    <textarea id="student_activity" name="student_activity" rows="8"><?php echo isset($old_input['student_activity']) ? htmlspecialchars($old_input['student_activity']) : ''; ?></textarea>
                </div>
            </div>
            <div id="deped-fields" style="display: none;">
                <div class="form-group">
                    <label for="school_name">School Name:</label>
                    <input type="text" id="school_name" name="school_name" value="<?php echo isset($old_input['school_name']) ? htmlspecialchars($old_input['school_name']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="teaching_dates">Teaching Dates and Time:</label>
                    <input type="text" id="teaching_dates" name="teaching_dates" value="<?php echo isset($old_input['teaching_dates']) ? htmlspecialchars($old_input['teaching_dates']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="grade_level">Grade Level:</label>
                    <input type="text" id="grade_level" name="grade_level" value="<?php echo isset($old_input['grade_level']) ? htmlspecialchars($old_input['grade_level']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="quarter">Quarter:</label>
                    <input type="text" id="quarter" name="quarter" value="<?php echo isset($old_input['quarter']) ? htmlspecialchars($old_input['quarter']) : ''; ?>">
                </div>
                 <div class="form-group">
                    <label for="content_standards">Content Standards:</label>
                    <textarea id="content_standards" name="content_standards" rows="4"><?php echo isset($old_input['content_standards']) ? htmlspecialchars($old_input['content_standards']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="performance_standards">Performance Standards:</label>
                    <textarea id="performance_standards" name="performance_standards" rows="4"><?php echo isset($old_input['performance_standards']) ? htmlspecialchars($old_input['performance_standards']) : ''; ?></textarea>
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
        <div id="notification"></div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>