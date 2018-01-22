<?php
/**
 * Created by PhpStorm.
 * User: mnobrega
 * Date: 21/01/2018
 * Time: 16:25
 */

namespace JiraAgileRestApi;
use JiraAgileRestApi\BacklogIssue\BacklogIssue;
use JiraAgileRestApi\BacklogIssue\BacklogIssueService;
use JiraAgileRestApi\Configuration\DotEnvConfiguration;
use JiraAgileRestApi\Issue\Issue;
use JiraAgileRestApi\Issue\IssueService;
use JiraAgileRestApi\IssueRank\IssueRank;
use JiraAgileRestApi\IssueRank\IssueRankService;
use JiraAgileRestApi\Sprint\Sprint;
use JiraAgileRestApi\Sprint\SprintIssue;
use JiraAgileRestApi\Sprint\SprintService;

require_once('../vendor/autoload.php');

$dotEnvConfig = new DotEnvConfiguration("../");
$issueRankService = new IssueRankService($dotEnvConfig);
$issueService = new IssueService($dotEnvConfig);
$backlogIssueService = new BacklogIssueService($dotEnvConfig);
$sprintService = new SprintService($dotEnvConfig);

try {
    // TEST change Rank
    $issueRank = new IssueRank();
    $issueRank->issues = [
        'VVESTIOS-142'
    ];
    $issueRank->rankBeforeIssue = 'VVESTIOS-138';
    $issueRankService->update($issueRank);

    // TEST get Issue
    $params = ["fields"=>"sprint"];
    $issue = $issueService->get("VVESTIOS-142",$params);
    /** @var $issue Issue */
    echo "\nTEST get Issue\n";
    print_r($issue);

    // TEST move Issues to Backlog
    $backlogIssue = new BacklogIssue();
    $backlogIssue->issues = [
        "VVESTIOS-142"
    ];
    $backlogIssueService->create($backlogIssue);

    // TEST get Sprint
    $sprint = $sprintService->get($issue->fields->sprint->id);
    echo "\nTEST get Sprint\n";
    print_r($sprint);

    // TEST update Sprint
    $now = new \DateTime();
    $now->modify("-5 second");
    $sprint->name = "Modified ".date("YmdHis");
    $sprint->startDate = $now->format(JiraClient::JIRA_DATE_FORMAT);
    $now->modify("+4 second");
    $sprint->endDate = $now->format(JiraClient::JIRA_DATE_FORMAT);
    $sprintService->update($sprint->id,$sprint);
    $sprint = $sprintService->get($issue->fields->sprint->id);
    echo "\nTEST update Sprint\n";
    print_r($sprint);

    // TEST create Sprint
    $now = new \DateTime();
    $newSprint = new Sprint();
    $newSprint->name = "Created ".date("YmdHis");
    $newSprint->startDate = $now->format(JiraClient::JIRA_DATE_FORMAT);
    $now->modify("+5 second");
    $newSprint->endDate = $now->format(JiraClient::JIRA_DATE_FORMAT);
    $newSprint->originBoardId = $issue->fields->sprint->originBoardId;
    $newSprint = $sprintService->create($newSprint);
    echo "\nTEST created Sprint\n";
    print_r($newSprint);

    // TEST move Issue to Sprint
    $sprintIssue = new SprintIssue();
    $sprintIssue->issues = [$issue->key];
    $sprintService->addIssues($newSprint->id,$sprintIssue);

    //ROLLBACK
    $sprintService->addIssues($issue->fields->sprint->id,$sprintIssue);
    $issueRank = new IssueRank();
    $issueRank->issues = [
        'VVESTIOS-138'
    ];
    $issueRank->rankBeforeIssue = 'VVESTIOS-142';
    $issueRankService->update($issueRank);
    $sprintService->delete($newSprint->id);


} catch (\Exception $e) {
    dd($e);
}
