<?php
$token = getenv('YOUTRACK_TOKEN');
$apiDomain = getenv('YOUTRACK_DOMAIN');
$commitMessage = getenv('CI_COMMIT_MESSAGE');
$jobUrl = getenv('CI_JOB_URL');
$youtrackGroupId = getenv('YOUTRACK_GROUP_ID');
$env = getenv('ENVIRONMENT');
$regex = '#[A-Z0-9]+-[0-9]+#';
$projectId = getenv('$CI_PROJECT_ID');
$apiDomain = getenv('CI_API_V4_URL') . '/';
$token = getenv('CI_JOB_TOKEN');

if (!$commitMessage) {
    die("No commit found \n");
}

function retryJob($jobId, $projectId, $apiDomain, $token) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiDomain . 'projects/' . $projectId . '/jobs/' . $jobId . '/retry');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'PRIVATE-TOKEN: ' . $token;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
}

function retryCanceledJobs($projectId, $apiDomain, $token) {
    $dateLastWeek = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " -1 week");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiDomain . 'projects/' . $projectId . '/jobs?scope[]=canceled');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'PRIVATE-TOKEN: ' . $token;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo $result . "\n";
        $jobs = json_decode($result, true);
        foreach ($jobs as $job) {
            if ($job['stage'] == 'notify' && $job['pipeline']['status']  == 'canceled' && !($job['finished_at'] < $dateLastWeek)) {
                retryJob($job['id'], $projectId, $apiDomain, $token);
            }
        }
        echo 'Old jobs launched';
    }
    curl_close($ch);
}

function createComment($apiDomain, $token, $issueId, $data)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $apiDomain . 'api/issues/' . $issueId . '/comments');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Authorization: Bearer ' . $token;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Comment added';
    }
    curl_close($ch);
}

preg_match_all($regex, $commitMessage, $res);
$res = array_unique($res[0]);

if (!count($res)) {
    die("No commit found \n");
}

foreach ($res as $issueId) {
    $message = '{"text": "Déployé en ' . $env . '"}';
    createComment($apiDomain, $token, $issueId, $message);
    $data = [
        'text' => 'Log: ' . $jobUrl,
        'visibility' => [
            'permittedGroups' => [
                ['id' => $youtrackGroupId]
            ],
            '$type' => "LimitedVisibility"
        ]
    ];
    $message = json_encode($data);
    createComment($apiDomain, $token, $issueId, $message);
}
retryCanceledJobs($projectId, $apiDomain, $token);
echo 'Done';
echo "\n";
