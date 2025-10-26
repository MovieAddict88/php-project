<div class="lesson-plan">
    <h2>Detailed Lesson Plan</h2>
    <p><strong>Teacher:</strong> <?php echo $teacher_name; ?></p>
    <p><strong>Subject:</strong> <?php echo $subject; ?></p>
    <p><strong>Topic:</strong> <?php echo $topic; ?></p>
    <h3>I. Objectives</h3>
    <p><?php echo $objectives; ?></p>
    <h3>II. Subject Matter</h3>
    <p><strong>Topic:</strong> <?php echo $topic; ?></p>
    <p><strong>Materials:</strong> <?php echo $materials; ?></p>
    <h3>III. Procedure</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Teacher's Activity</th>
            <th>Student's Activity</th>
        </tr>
        <tr>
            <td><?php echo $teacher_activity; ?></td>
            <td><?php echo $student_activity; ?></td>
        </tr>
    </table>
    <h3>IV. Evaluation</h3>
    <p><?php echo $evaluation; ?></p>
    <h3>V. Assignment</h3>
    <p><?php echo $assignment; ?></p>
</div>