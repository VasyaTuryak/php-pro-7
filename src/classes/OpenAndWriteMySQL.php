<?php

class OpenAndWriteMySQL implements \Interface\WorkWithDB
{

    public function getArrayOfUrl(): array
    {
        $full=array();
        foreach(Model\Url::all() as $row){
            $full[]=$row->short_url;
            $full[]=$row->long_url;
        };
        return $full;
    }

    public function saveNewUrl(array $url): void
    {
        $write_new_url=new Model\Url();
        $length_of_array=count($url);
        $write_new_url->short_url=$url[$length_of_array-2];
        $write_new_url->long_url=$url[$length_of_array-1];
        $write_new_url->save();
    }
}