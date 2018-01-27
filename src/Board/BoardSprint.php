<?php
/**
 * Created by PhpStorm.
 * User: mnobrega
 * Date: 27/01/2018
 * Time: 00:52
 */

namespace JiraAgileRestApi\Board;


class BoardSprint implements \JsonSerializable
{
    /** @var integer */
    public $maxResults;
    /** @var integer */
    public $startAt;
    /** @var boolean */
    public $isLast;
    /** @var \JiraAgileRestApi\Sprint\Sprint[]|null */
    public $values;

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}