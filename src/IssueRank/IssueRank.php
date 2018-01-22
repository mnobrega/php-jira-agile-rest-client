<?php
/**
 * Created by PhpStorm.
 * User: mnobrega
 * Date: 21/01/2018
 * Time: 16:14
 */

namespace JiraAgileRestApi\IssueRank;

class IssueRank implements \JsonSerializable
{
    /** @var string[] */
    public $issues;
    /** @var string */
    public $rankBeforeIssue;
    /** @var string */
    public $rankCustomFieldId;

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}