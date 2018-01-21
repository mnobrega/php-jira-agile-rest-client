<?php
/**
 * Created by PhpStorm.
 * User: mnobrega
 * Date: 21/01/2018
 * Time: 16:25
 */

namespace JiraAgileRestApi;
use JiraAgileRestApi\Configuration\DotEnvConfiguration;
use JiraAgileRestApi\IssueRank\IssueRankService;

require_once('../vendor/autoload.php');

$dotEnvConfig = new DotEnvConfiguration("../");
dd($dotEnvConfig);
$issueRankService = new IssueRankService();