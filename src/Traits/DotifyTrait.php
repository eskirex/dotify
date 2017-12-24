<?php

namespace Eskirex\Component\Dotify\Traits;

use ArrayIterator;

trait DotifyTrait
{
    protected $data;

    /**
     * @param mixed $data
     */
    protected function init($data = null)
    {
        if (is_string($data)) {
            $this->data = (array)$data;
        }

        if (is_array($data)) {
            $this->data = $data;
        }

        if ($data instanceof self) {
            $this->data = $data->getAll();
        }

    }


    /**
     * @param array $arr
     * @return bool
     */
    protected function doSet(array $arr)
    {
        foreach ($arr as $name => $data) {
            $this->save($name, $data);
        }

        return true;
    }


    /**
     * @param array $arr
     * @return null
     */
    protected function doFetch(array $arr)
    {
        $return = null;

        foreach ($arr as $name) {
            $return[$name] = $this->fetch($name);
        }

        return count($return) > 1 ? $return : array_values($return)[0];
    }


    /**
     * @param mixed $name
     * @param mixed $options
     * @return mixed
     */
    protected function doFetchJson($name = null, $options = 0)
    {
        if ($name === null) {
            return json_encode($this->data, $options);
        }

        $fetch = $this->fetch($name);

        return $fetch ? json_encode($fetch, $options) : $fetch;
    }


    /**
     * @param array $arr
     * @return mixed
     */
    protected function doHave(array $arr)
    {
        $return = null;

        foreach ($arr as $name) {
            $return[$name] = $this->exists($name);
        }

        return count($return) > 1 ? $return : array_values($return)[0];
    }


    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    protected function doMerge($name, $value)
    {
        $fetch = $this->fetch($name);

        if ($fetch === null) {
            return false;
        }

        if(!is_array($fetch)){
            $fetch = [$fetch];
            print_r($fetch);
        }

        $merge = is_array($value) ? $value : (array)$value;
        $this->set($name, array_merge($fetch, $merge));

        return $this->fetch($name);
    }


    /**
     * @param array $arr
     * @return mixed
     */
    protected function doDelete(array $arr)
    {
        $return = null;

        foreach ($arr as $name) {
            $return[$name] = $this->delete($name);
        }

        return count($return) > 1 ? $return : array_values($return)[0];
    }


    /**
     * @return bool
     */
    protected function doClear()
    {
        $this->data = [];

        return true;
    }


    /**
     * @param $name
     * @param $data
     * @return bool
     */
    protected function save($name, $data)
    {
        $items =& $this->data;

        foreach (explode('.', $name) as $key) {
            if (!isset($items[$key]) || !is_array($items[$key])) {
                $items[$key] = [];
            }

            $items = &$items[$key];
        }

        $items = $data;

        return true;
    }


    /**
     * @param null $name
     * @return mixed|null
     */
    protected function fetch($name = null)
    {
        if (is_null($name)) {
            return $this->data;
        }

        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        if (strpos($name, '.') === false) {
            return null;
        }

        $items = $this->data;

        foreach (explode('.', $name) as $segment) {
            if (!is_array($items) || !array_key_exists($segment, $items)) {
                return null;
            }

            $items =& $items[$segment];
        }

        return $items;

    }


    /**
     * @param string $name
     * @return bool
     */
    protected function exists($name)
    {
        $keys = (array)$name;

        if (!$this->data || $keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $items = $this->data;

            if (array_key_exists($key, $items)) {
                continue;
            }

            foreach (explode('.', $key) as $segment) {
                if (!is_array($items) || !array_key_exists($segment, $items)) {
                    return false;
                }

                $items = $items[$segment];
            }
        }

        return true;
    }


    /**
     * @param $name
     * @return bool
     */
    protected function delete($name)
    {
        $keys = (array)$name;

        foreach ($keys as $key) {
            if (array_key_exists($key, $this->data)) {
                unset($this->data[$key]);

                continue;
            }

            $items = &$this->data;
            $segments = explode('.', $key);
            $lastSegment = array_pop($segments);

            foreach ($segments as $segment) {
                if (!isset($items[$segment]) || !is_array($items[$segment])) {
                    continue 2;
                }

                $items =& $items[$segment];
            }

            unset($items[$lastSegment]);
        }
        return true;
    }


    /**
     * @param $data
     * @return array
     */
    protected function importArray($data)
    {
        if (is_array($data)) {
            $this->data = $data;
        } elseif ($data instanceof self) {
            $this->data = $data->getAll();
        }

        return (array)$data;
    }


    /**
     * @param array $data
     * @return bool
     */
    protected function importReferenceArray(Array &$data)
    {
        $this->data =& $data;
        return true;
    }


    /**
     * @return array|null
     */
    protected function getAll()
    {
        return $this->data ?? null;
    }


    /**
     * @param string|null $name
     * @return int|null
     */
    protected function getCount(string $name = null)
    {
        if ($name === null) {
            return $this->data !== null ? count($this->data) : null;
        }

        $fetch = $this->fetch($name);
        return $fetch !== null ? count($fetch) : null;
    }


    /**
     * @return ArrayIterator
     */
    protected function getIterator()
    {
        return new ArrayIterator($this->data);
    }
}