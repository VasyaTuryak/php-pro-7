<?php

namespace App\Interface;

interface IUrlDecoder
{
    /**
     * @param string $code
     * @return string
     * @throws \InvalidArgumentException
     */
    public function decode(string $code): string;
}