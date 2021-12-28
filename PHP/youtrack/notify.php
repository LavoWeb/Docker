<?php
$token = getenv('YOUTRACK_TOKEN');
$apiDomain = getenv('YOUTRACK_DOMAIN');
$commitMessage = getenv('CI_COMMIT_MESSAGE');
$jobUrl = getenv('CI_JOB_URL');
$youtrackGroupId = getenv('YOUTRACK_GROUP_ID');
$env = getenv('ENVIRONMENT');
$regex = '#[A-Z0-9]+-[0-9]+#';

if (!$commitMessage) {
    die("No commit found \n");
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
echo 'Done';
echo "\n";
