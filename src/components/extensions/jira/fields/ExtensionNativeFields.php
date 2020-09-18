<?php
namespace extas\components\extensions\jira\fields;

use extas\components\extensions\Extension;
use extas\interfaces\extensions\jira\fields\IExtensionNativeFields;

/**
 * Class ExtensionNativeFields
 *
 * @package extas\components\extensions\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
class ExtensionNativeFields extends Extension implements IExtensionNativeFields
{
    use THasFieldActive;
    use THasFieldAvatarId;
    use THasFieldAvatarUrls;
    use THasFieldDescription;
    use THasFieldDisplayName;
    use THasFieldEmailAddress;
    use THasFieldIconUrl;
    use THasFieldId;
    use THasFieldInwardIssue;
    use THasFieldIssueLinks;
    use THasFieldKey;
    use THasFieldLinkType;
    use THasFieldName;
    use THasFieldOutwardIssue;
    use THasFieldPercent;
    use THasFieldProgress;
    use THasFieldProjectTypeKey;
    use THasFieldSelf;
    use THasFieldStatusCategory;
    use THasFieldSubtask;
    use THasFieldTimeZone;
    use THasFieldTotal;
    use THasFieldValue;
}
