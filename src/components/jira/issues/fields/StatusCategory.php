<?php
namespace extas\components\jira\issues\fields;

use extas\components\extensions\jira\fields\THasFieldId;
use extas\components\extensions\jira\fields\THasFieldKey;
use extas\components\extensions\jira\fields\THasFieldName;
use extas\components\extensions\jira\fields\THasFieldSelf;
use extas\interfaces\jira\issues\fields\IStatusCategory;

/**
 * Class StatusCategory
 *
 * @package extas\components\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
class StatusCategory extends Field implements IStatusCategory
{
    use THasFieldName;
    use THasFieldKey;
    use THasFieldId;
    use THasFieldSelf;

    /**
     * StatusCategory constructor.
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
    public function getFieldColorName(): string
    {
        return $this->getParameterValue(static::PARAM__COLOR_NAME, '');
    }
}
