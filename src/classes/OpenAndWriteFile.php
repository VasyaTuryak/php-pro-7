<?php



class OpenAndWriteFile implements \Interface\WorkWithDB
{


    public string $path ='./src/StoreURL.txt';

    public function getArrayOfUrl(): array
    {
        $open_file = fopen($this->path, 'a+');
        $open_array = array();
        while ($line = fgets($open_file)) {
            $open_array[] = trim($line, '');
        }
        fclose($open_file);
        return $open_array;
    }

    public function saveNewUrl(array $url): void
    {
        $file_new = fopen($this->path, 'w');
        $length = count($url);
        for ($i = 0; $i < $length; $i++) {
            fwrite($file_new, $url[$i]);
        }
    }
}