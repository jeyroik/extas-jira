<?php
namespace extas\components\jira\issues\fields;

use extas\components\Item;
use extas\components\jira\THasSchema;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\jira\issues\fields\IField;

/**
 * Class Field
 *
 * @package extas\components\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
class Field extends Item implements IField
{
    use THasSampleParameters;
    use THasName;
    use THasDescription;
    use THasSchema;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
