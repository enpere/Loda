<?php namespace Loda;

use ArrayAccess;
use Closure;
use Countable;
use JsonSerializable;

class Loda implements ArrayAccess, JsonSerializable, Countable
{
    /**
     * Collection
     *
     * @var [Array]
     */
    private $loda = [];

    public function __construct(Array $loda)
    {
        $this->loda = $loda;
    }

    public function shift()
    {
        return array_shift($this->loda);
    }

    public function each(Closure $callback)
    {
        foreach ($this->loda as $key => $value) {
            $callback($key, $value);
        }
    }

    public function filter(Closure $callback)
    {
        return new Loda(array_filter($this->loda, $callback));
    }

    public function push($value, $key = false)
    {
        if(!$key)
        {
           $this->loda[] = $value;
        } else {
           $this->loda[$key] = $value;
        }
    }

    public function all()
    {
       return $this->loda;
    }

    public function toJson()
    {
        return json_encode($this->loda);
    }

    public function jsonSerialize()
    {
        return $this->loda;
    }

    public function offsetExists($offset)
    {
        return isset($this->loda[$offset]);
    }

    public function offsetGet($offset)
    {
        if($this->offsetExists($offset))
        {
            return $this->loda($offset);
        }
    }

    public function offsetSet($offset, $value)
    {
        $this->loda[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if($this->offsetExists($offset))
        {
            unset($this->loda[$offset]);
        }
    }

    public function count()
    {
        return count($this->loda);
    }
}

