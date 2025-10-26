<?php
session_start();
require_once('vendor/tcpdf/tcpdf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Server-side validation
    $errors = [];
    $required_fields = ['teacher_name', 'subject', 'topic', 'objectives', 'materials', 'evaluation'];
    $template = $_POST['template'];

    if ($template === 'detailed') {
        $required_fields = array_merge($required_fields, ['teacher_activity', 'student_activity']);
    } else {
        $required_fields[] = 'procedure';
    }

    if ($template === 'deped') {
        $required_fields = array_merge($required_fields, ['school_name', 'teaching_dates', 'grade_level', 'quarter', 'content_standards', 'performance_standards']);
    }

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $_POST;
        header('Location: index.php');
        exit;
    }
    // Sanitize and retrieve POST data
    $teacher_name = htmlspecialchars($_POST['teacher_name']);
    $subject = htmlspecialchars($_POST['subject']);
    $topic = htmlspecialchars($_POST['topic']);
    $template = htmlspecialchars($_POST['template']);

    // Define allowed tags for rich text fields to prevent XSS
    $allowed_tags = '<p><br><b><i><strong><em><ul><ol><li><table><thead><tbody><tfoot><tr><th><td>';

    $objectives = strip_tags($_POST['objectives'], $allowed_tags);
    $materials = strip_tags($_POST['materials'], $allowed_tags);
    $procedure = strip_tags($_POST['procedure'], $allowed_tags);
    $evaluation = strip_tags($_POST['evaluation'], $allowed_tags);
    $assignment = strip_tags($_POST['assignment'], $allowed_tags);

    // Detailed fields
    $teacher_activity = isset($_POST['teacher_activity']) ? strip_tags($_POST['teacher_activity'], $allowed_tags) : '';
    $student_activity = isset($_POST['student_activity']) ? strip_tags($_POST['student_activity'], $allowed_tags) : '';

    // DepEd fields
    $school_name = isset($_POST['school_name']) ? htmlspecialchars($_POST['school_name']) : '';
    $teaching_dates = isset($_POST['teaching_dates']) ? htmlspecialchars($_POST['teaching_dates']) : '';
    $grade_level = isset($_POST['grade_level']) ? htmlspecialchars($_POST['grade_level']) : '';
    $quarter = isset($_POST['quarter']) ? htmlspecialchars($_POST['quarter']) : '';
    $content_standards = isset($_POST['content_standards']) ? strip_tags($_POST['content_standards'], $allowed_tags) : '';
    $performance_standards = isset($_POST['performance_standards']) ? strip_tags($_POST['performance_standards'], $allowed_tags) : '';


    // Load the selected template
    $template_path = 'templates/' . $template . '.php';

    if (file_exists($template_path)) {
        ob_start();
        include $template_path;
        $html = ob_get_clean();

        // Create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($teacher_name);
        $pdf->SetTitle('Lesson Plan - ' . $subject);
        $pdf->SetSubject($topic);

        // Add a page
        $pdf->AddPage();

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // Close and output PDF document
        $pdf->Output('lesson_plan.pdf', 'I');

    } else {
        echo "Error: Template not found.";
    }
} else {
    header('Location: index.php');
}
?>