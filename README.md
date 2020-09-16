![tests](https://github.com/jeyroik/extas-jira/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-jira/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a> 

[![Latest Stable Version](https://poser.pugx.org/jeyroik/extas-jira/v)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Total Downloads](https://poser.pugx.org/jeyroik/extas-jira/downloads)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Dependents](https://poser.pugx.org/jeyroik/extas-jira/dependents)](//packagist.org/packages/jeyroik/extas-q-crawlers)

# Описание

Jira REST API client for Extas

# Использование

```php
use extas\components\Item;
use extas\interfaces\jira\issues\IIssue;
use extas\interfaces\jira\IJIraRepository;

/**
 * @method IJIraRepository jiraIssues()
 */
class My extends Item
{
    public function getIssuesIds()
    {
        /**
         * @var IIssue[] $issues
         */
        $issues = $this->jiraIssues('jira_instance_1', 'secret.password')->all([IIssue::FIELD__FIELDS_ASSIGNEE => 'some@user']);
        return array_column($issues, IIssue::FIELD__ID);
    }

    protected function getSubjectForExtension() : string
    {
        return 'my';
    }
}
```