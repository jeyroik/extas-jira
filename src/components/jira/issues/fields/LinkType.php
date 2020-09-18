<?php
namespace extas\components\jira\issues\fields;

use extas\components\extensions\jira\fields\THasFieldId;
use extas\components\extensions\jira\fields\THasFieldName;
use extas\components\extensions\jira\fields\THasFieldSelf;
use extas\interfaces\jira\issues\fields\ILinkType;

/**
 * Class LinkType
 *
 * @package extas\components\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
class LinkType extends Field implements ILinkType
{
    use THasFieldId;
    use THasFieldSelf;
    use THasFieldName;

    /**
     * LinkType constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct([]);
        $this->addParametersByValues($config);
    }

    /**
     * @return string
     */
    public function getInward(): string
    {
        return $this->getParameterValue(static::PARAM__FIELD_INWARD, '');
    }

    /**
     * @return string
     */
    public function getOutward(): string
    {
        return $this->getParameterValue(static::PARAM__FIELD_OUTWARD, '');
    }
}
