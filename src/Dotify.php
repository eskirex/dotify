<?php

namespace Eskirex\Component\Dotify;

use Eskirex\Component\Dotify\Traits\DotifyTrait;
use Eskirex\Component\Dotify\Interfaces\IDotify;

class Dotify implements IDotify
{
    use DotifyTrait;


    /**
     * Dotify constructor.
     *
     * Can import array.
     * Can import object (Dotify)
     *
     * @param array|object|string|null $data
     */
    public function __construct($data = null)
    {
        $this->init($data);
    }


    /**
     * Set key to value
     *
     * @param string $key
     * @param array|string $value
     * @return bool
     */
    public function set($key, $value)
    {
        return $this->doSet([$key => $value]);
    }


    /**
     * Set key value
     *
     * Can set multiple
     *
     * @param array $key
     * @return bool
     */
    public function setMultiple($key)
    {
        return $this->doSet($key);
    }


    /**
     * Get key value
     *
     * @param string $key
     * @return array|null|string
     */
    public function get($key)
    {
        return $this->doFetch([$key]);
    }


    /**
     * Get key value
     *
     * Can get multiple
     *
     * @param array $key
     * @return bool|null
     */
    public function getMultiple($key)
    {
        return $this->doFetch($key);
    }


    /**
     * Check exist key
     *
     * @param string $key
     * @return bool|null
     */
    public function has($key)
    {
        return $this->doHave([$key]);
    }


    /**
     * Check exist key
     *
     * Can check exist multiple
     *
     * @param array $key
     * @return bool|null
     */
    public function hasMultiple($key)
    {
        return $this->doHave($key);
    }


    /**
     * Merge key value
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function merge($key, $value)
    {
        return $this->doMerge($key, $value);
    }


    /**
     * Delete key
     *
     * @param string $key
     * @return bool|null
     */
    public function del($key)
    {
        return $this->doDelete([$key]);
    }


    /**
     * Delete key
     *
     * Can delete key multiple
     *
     * @param array $key
     * @return bool|null
     */
    public function delMultiple($key)
    {
        return $this->doDelete($key);
    }


    /**
     * Clear all data
     *
     * @return bool
     */
    public function clear()
    {
        return $this->doClear();
    }


    /**
     * Import data
     *
     * Can import Dotify object
     *
     * @param $data
     * @return array
     */
    public function setArray($data)
    {
        return $this->importArray($data);
    }


    /**
     * Import reference data
     *
     * @param array $data
     * @return bool
     */
    public function setReferenceArray(Array &$data)
    {
        return $this->importReferenceArray($data);
    }


    /**
     * Get all data
     *
     * @return mixed
     */
    public function all()
    {
        return $this->getAll();
    }


    /**
     * Get count key
     *
     * If empty $key param will callback all data count value
     *
     * @param null $key
     * @return int|null
     */
    public function count($key = null)
    {
        return $this->getCount($key);
    }


    /**
     * Get all data with ArrayIterator
     *
     * @return mixed
     */
    public function iterator()
    {
        return $this->getIterator();
    }


    /**
     * Get key and convert json
     *
     * If empty $key param will callback all data with json
     *
     * @param null $key
     * @param int $options
     * @return null|string
     */
    public function getJson($key = null, $options = 0)
    {
        return $this->doFetchJson($key, $options);
    }
}