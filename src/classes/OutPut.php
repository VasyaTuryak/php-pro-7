<?php

use App\Interface\IUrlDecoder;
require 'CheckUrl.php';
class OutPut extends CheckUrl implements IUrlDecoder
{
    protected array $array_of_url;
    public function setter($array_of_url):void{
        $this->array_of_url=$array_of_url;
    }
    public function decode(string $code): string
    {
        // TODO: Implement encode() method.

        if (!filter_var($code, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid Short URL, check that' . PHP_EOL);
        }
        $position_of_url=CheckUrl::search($this->array_of_url,$code);
        return $this->array_of_url[$position_of_url+1];
    }

}