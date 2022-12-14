<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2022-07-25
 * Time: 21:56
 */

namespace JoseChan\Entity;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use JoseChan\Entity\Factory\IEntityFactory;

/**
 * Class Entity
 * @package JoseChan\entity\src
 */
class Entity implements \ArrayAccess, Arrayable, \Iterator, \JsonSerializable
{
    protected $data = [];

    protected $arrayAttributeEntity = [];

    /** @var IEntityFactory $entityFactory */
    protected $entityFactory;

    /**
     * Entity constructor.
     * @param array $data
     * @param IEntityFactory $factory
     */
    public function __construct(array $data, IEntityFactory $factory)
    {
        $this->entityFactory = $factory;
        $this->data = $this->buildData($data);
    }

    /**
     * @param array $data
     * @return array
     */
    private function buildData(array $data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $entity = $this->arrayAttributeEntity[$key] ?? $this->arrayAttributeDefaultEntity();
                if (!$this->isIndexArray($value)) {
                    $result[$key] = $this->factory()->make($entity, ["data" => $value]);
                    continue;
                }

                $collection = method_exists($entity, "collection") ?
                    $entity::collection() : self::collection();

                /** @var Collection $collection */
                $collection = new $collection();
                foreach ($value as $item) {
                    if(is_array($item)){
                        $item = $this->factory()->make($entity, ["data" => $item]);
                    }
                    $collection->push($item);
                }

                $value = $collection;
            }

            $result[$key] = $value;
        }

        return $result;
    }

    protected function factory()
    {
        return $this->entityFactory;
    }


    public function toArray()
    {
        $data = [];
        foreach ($this->data as $field => $value) {
            $value instanceof Arrayable && $value = $value->toArray();
            $data[$field] = $value;
        }
        return $data;
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function current()
    {
        return current($this->data);
    }

    public function next()
    {
        next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function valid()
    {
        $key = $this->key();
        return isset($this->data[$key]);
    }

    public function rewind()
    {
        reset($this->data);
    }

    public function jsonSerialize()
    {
        return $this->data;
    }

    public function isIndexArray(array $data)
    {
        return count(array_filter(array_keys($data), 'is_string')) === 0;
    }

    protected static function collection()
    {
        return Collection::class;
    }

    protected function arrayAttributeDefaultEntity()
    {
        return Entity::class;
    }

    public function __isset($offset)
    {
        return isset($this->data[$offset]);
    }

    public function __get($offset)
    {
        return $this->data[$offset] ?? null;
    }

    public function __set($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function __unset($offset)
    {
        unset($this->data[$offset]);
    }
}
