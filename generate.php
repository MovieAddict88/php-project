<?php
require_once('vendor/tcpdf/tcpdf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve POST data
    $teacher_name = htmlspecialchars($_POST['teacher_name']);
    $subject = htmlspecialchars($_POST['subject']);
    $topic = htmlspecialchars($_POST['topic']);
    $objectives = nl2br(htmlspecialchars($_POST['objectives']));
    $materials = nl2br(htmlspecialchars($_POST['materials']));
    $procedure = nl2br(htmlspecialchars($_POST['procedure']));
    $evaluation = nl2br(htmlspecialchars($_POST['evaluation']));
    $assignment = nl2br(htmlspecialchars($_POST['assignment']));
    $template = htmlspecialchars($_POST['template']);

    // Detailed fields
    $teacher_activity = isset($_POST['teacher_activity']) ? nl2br(htmlspecialchars($_POST['teacher_activity'])) : '';
    $student_activity = isset($_POST['student_activity']) ? nl2br(htmlspecialchars($_POST['student_activity'])) : '';

    // DepEd fields
    $school_name = isset($_POST['school_name']) ? htmlspecialchars($_POST['school_name']) : '';
    $teaching_dates = isset($_POST['teaching_dates']) ? htmlspecialchars($_POST['teaching_dates']) : '';
    $grade_level = isset($_POST['grade_level']) ? htmlspecialchars($_POST['grade_level']) : '';
    $quarter = isset($_POST['quarter']) ? htmlspecialchars($_POST['quarter']) : '';
    $content_standards = isset($_POST['content_standards']) ? nl2br(htmlspecialchars($_POST['content_standards'])) : '';
    $performance_standards = isset($_POST['performance_standards']) ? nl2br(htmlspecialchars($_POST['performance_standards'])) : '';


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