<?php

namespace SmartHome\App\Helpers;

trait HasName
{
    protected function getLangKey(): string
    {
        return strtolower($this->getClassShortName());
    }

    /**
     * Название
     *
     * @return string
     * @throws \ReflectionException
     */
    public function name(): string
    {
        $key = 'device.' . $this->getLangKey() . '.' . get_class($this) . '.name';

        $name = trans($key);

        return $name != $key ? $name : $this->getClassShortName();
    }

    /**
     * Описание
     *
     * @return string/null
     */
    public function description()
    {
        $key = 'device.' . $this->getLangKey() . '.' . get_class($this) . '.description';

        $description = trans($key);

        return $description != $key ? $description : null;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    protected function getClassShortName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}