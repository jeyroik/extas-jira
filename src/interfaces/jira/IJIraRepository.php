<?php
namespace extas\interfaces\jira;

use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\repositories\IRepository;

/**
 * Interface IJIraRepository
 *
 * @package extas\interfaces\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IJIraRepository extends IRepository
{
    public const SUBJECT = 'extas.jira.repository';
    public const SERVICE__NAME = 'jira';

    public const FIELD__RESULT_CLASS_GET = 'result.class.get';
    public const FIELD__RESULT_CLASS_POST = 'result.class.post';
    public const FIELD__RESULT_CLASS_PUT = 'result.class.put';
    public const FIELD__RESULT_CLASS_DELETE = 'result.class.delete';
    public const FIELD__SECRET_PASSWORD = 'secret.password';

    /**
     * @param array $result
     * @return mixed
     * @throws MissedOrUnknown
     */
    public function getResult(array $result);

    /**
     * @param array $result
     * @return mixed
     * @throws MissedOrUnknown
     */
    public function postResult(array $result);

    /**
     * @param array $result
     * @return mixed
     * @throws MissedOrUnknown
     */
    public function putResult(array $result);

    /**
     * @param array $result
     * @return mixed
     * @throws MissedOrUnknown
     */
    public function deleteResult(array $result);
}
