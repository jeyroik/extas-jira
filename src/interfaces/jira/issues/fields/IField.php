<?php
namespace extas\interfaces\jira\issues\fields;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\jira\IHasSchema;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface IField
 *
 * @package extas\interfaces\jira\issues\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IField extends IItem, IHasSampleParameters, IHasName, IHasDescription, IHasSchema
{
    public const SUBJECT = 'extas.jira.issue.field';
}
