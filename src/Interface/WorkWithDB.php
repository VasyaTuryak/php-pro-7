<?php

namespace Interface;

interface WorkWithDB
{
public function getArrayOfUrl():array;

public function saveNewUrl(array $url):void;

}