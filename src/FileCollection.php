<?php

namespace Live\Collection;

/**
 * File collection
 *
 * @package Live\Collection
 */
class FileCollection implements CollectionInterface
{
    /**
     * Collection data
     *
     * @var array
     **/
    protected $data;

    /**
     * Path of data file
     *
     * @var string
     */
    protected $path;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = "src/include/file.json";
        $file = fopen($this->path, 'w+') or die('Cannot create file: ' .$this->path);
        $this->data = file($this->path);
    }

     /**
     * {@inheritDoc}
     */
    public function get(string $index, $defaultValue = null)
    {
        if (!$this->has($index)) {
            return $defaultValue;
        }
        return $this->data[$index];
    }

     /**
     * {@inheritDoc}
     */
    public function set(string $index, $value)
    {
        $this->data[$index] = $value;
        file_put_contents($this->path, json_encode($this->data));
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $index)
    {
        return array_key_exists($index, $this->data);
    }

     /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function clean()
    {
        $this->data = [];
        file_put_contents($this->path, '');
    }
}
