<?php

class Loda implements ArrayAccess, JsonSerializable, Countable
{
    /**
     * Collection
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

    public function put($value, $key = false)
    {
        if(!$key)
        {
           $this->loda[] = $value;
        } else {
           $this->loda[$key] = $value;
        }
    }

    public function map(Closure $callback)
    {
        return new Loda(array_map($callback, $this->loda));
    }


    public function forget($key)
    {
        if($this->pick($key) !== null)
        {
           $picked =  $this->pick($key);
           unset($this[$key]);
        }
        return $picked;
    }

    public function pick($key)
    {
       $chosen = null;
       if($this->offsetExists($key))
       {
          $chosen = $this->loda[$key];
       }
       return $chosen;
    }

    public function all()
    {
       return $this->loda;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->loda);
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
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        if($this->has($offset))
        {
            return $this->loda[$offset];
        }
    }

    public function offsetSet($offset, $value)
    {
        $this->loda[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if($this->has($offset))
        {
            unset($this->loda[$offset]);
        }
    }

    public function count()
    {
        return count($this->loda);
    }
}

