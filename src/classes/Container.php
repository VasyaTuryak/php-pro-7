<?php
use Psr\Container\ContainerInterface;
class Container implements ContainerInterface
{
    public array $entries = [];

    public function __construct($config)
    {
        $this->entries=$config;
    }

    public function get(string $id)
    {
        if(!$this->has($id)){
            throw new NotFoundServiceException('You entered incorrect service, check that.'.PHP_EOL);
        }

            return new $this->entries[$id]();
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

}