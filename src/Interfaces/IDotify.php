<?php
/**
 * Created by PhpStorm.
 * User: Can
 * Date: 12.12.2017
 * Time: 01:18
 */

namespace Eskirex\Component\Dotify\Interfaces;

interface IDotify
{
    /**
     * Dotify constructor.
     *
     * Can import array.
     * Can import object (Dotify)
     *
     * @param array|object|string|null $data
     */
    public function __construct($data = null);

    /**
     * Set key to value
     *
     * @param string $key
     * @param array|string $value
     * @return bool
     */
    public function set($key, $value);


    /**
     * Set key value
     *
     * Can set multiple
     *
     * @param array $key
     * @return bool
     */
    public function setMultiple($key);


    /**
     * Get key value
     *
     * @param string $key
     * @return array|null|string
     */
    public function get($key);


    /**
     * Get key value
     *
     * Can get multiple
     *
     * @param array $key
     * @return bool|null
     */
    public function getMultiple($key);


    /**
     * Check exist key
     *
     * @param string $key
     * @return bool|null
     */
    public function has($key);


    /**
     * Check exist key
     *
     * Can check exist multiple
     *
     * @param array $key
     * @return bool|null
     */
    public function hasMultiple($key);


    /**
     * Merge key value
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function merge($key, $value);


    /**
     * Delete key
     *
     * @param string $key
     * @return bool|null
     */
    public function del($key);


    /**
     * Delete key
     *
     * Can delete key multiple
     *
     * @param array $key
     * @return bool|null
     */
    public function delMultiple($key);


    /**
     * Clear all data
     *
     * @return bool
     */
    public function clear();

    /**
     * Import data
     *
     * Can import Dotify object
     *
     * @param $data
     * @return array
     */
    public function setArray($data);

    /**
     * Import reference data
     *
     * @param array $data
     * @return bool
     */
    public function setReferenceArray(Array &$data);

    /**
     * Get all data
     *
     * @return mixed
     */
    public function all();

    /**
     * Get count key
     *
     * If empty $key param will callback all data count value
     *
     * @param null $key
     * @return int|null
     */
    public function count($key = null);

    /**
     * Get all data with ArrayIterator
     *
     * @return mixed
     */
    public function iterator();

    /**
     * Get key and convert json
     *
     * If empty $key param will callback all data with json
     *
     * @param null $key
     * @param int $options
     * @return null|string
     */
    public function getJson($key = null, $options = 0);
}