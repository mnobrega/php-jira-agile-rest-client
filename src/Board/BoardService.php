<?php
/**
 * Created by PhpStorm.
 * User: mnobrega
 * Date: 27/01/2018
 * Time: 00:50
 */

namespace JiraAgileRestApi\Board;

use JiraAgileRestApi\JiraClient;

class BoardService extends JiraClient
{
    private $uri = '/board';

    /**
     * @param $boardId
     * @param array $paramArray
     * @return object
     * @throws \JiraAgileRestApi\JiraException
     * @throws \JsonMapper_Exception
     */
    public function getSprints($boardId, $paramArray = [])
    {
        $boardSprint = new BoardSprint();

        $ret = $this->exec($this->uri.'/'.$boardId.'/sprint'.$this->toHttpQueryParameter($paramArray), null);

        $this->log->addInfo("Result=\n".$ret);

        return $issue = $this->json_mapper->map(
            json_decode($ret), $boardSprint
        );
    }
}