<?php
/**
 * Created by PhpStorm.
 * User: mnobrega
 * Date: 21/01/2018
 * Time: 16:25
 */

namespace JiraAgileRestApi;
use JiraAgileRestApi\Configuration\DotEnvConfiguration;
use JiraAgileRestApi\IssueRank\IssueRank;
use JiraAgileRestApi\IssueRank\IssueRankService;

require_once('../vendor/autoload.php');

$dotEnvConfig = new DotEnvConfiguration("../");
$issueRankService = new IssueRankService($dotEnvConfig);

$issueRank = new IssueRank();
$issueRank->issues = [
    'VVESTIOS-141'
];
$issueRank->rankBeforeIssue = 'VVESTIOS-137';
try {
    $issueRankService->update($issueRank);
} catch (\Exception $e) {
    dd($e);
}
