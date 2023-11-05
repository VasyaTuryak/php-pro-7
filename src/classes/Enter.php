<?php

use App\Interface\IUrlEncoder;

class Enter implements IUrlEncoder
{
    protected string $prefix = "";
    protected int $max_length = 0;

    public function setter(string $prefix, int $max_length): void
    {
        $this->prefix = $prefix;
        $this->max_length = $max_length;
    }

    public function encode(string $url): string
    {
        // TODO: Implement encode() method.
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid Long URL' . PHP_EOL);
        }
        $n = $this->max_length - strlen($this->prefix);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $random_string .= $characters[$index];
        }

        return $random_string;
    }

}