<?php
try {
    $_POST['post_add'] = 1;
    $_POST['Add_job_cate'] = '1';
    $_POST['job_name'] = 'Test';
    $_POST['job_location'] = 'Test';
    $_POST['post_date'] = '2026-10-05';
    $_POST['last_date'] = '2026-10-10';
    $_POST['job_details'] = 'Test';
    include('Add_want_job_post.php');
} catch (Throwable $e) {
    echo "ERROR CAUGHT: " . $e->getMessage() . "\n";
}
