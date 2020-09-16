<?php
namespace extas\components\jira;

use extas\components\Item;
use extas\components\THasPath;
use extas\interfaces\jira\IUri;

/**
 * Class Uri
 *
 * @package extas\components\jira
 * @author jeyroik <jeyroik@gmail.com>
 */
class Uri extends Item implements IUri
{
    use THasPath;

    protected array $params = [];

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getPath() . '?' . implode('&', $this->params);
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this|Uri
     */
    public function add(string $name, string $value)
    {
        $this->params[] = $name . '=' . $value;

        return $this;
    }

    /**
     * @param array $params
     * @return $this|Uri
     */
    public function addParams(array $params)
    {
        foreach ($params as $name => $value) {
            $this->add($name, $value);
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
