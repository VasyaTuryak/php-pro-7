<?php

class CheckUrl
{
    public function search(array $array, string $url): int
    {
        $position_in_array = -1;
        foreach ($array as $key => $value) {
            if (trim($value, "\n") === $url) {
                $position_in_array = $key;
            }
        }
        return $position_in_array;
    }
}