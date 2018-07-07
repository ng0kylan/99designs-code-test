<?php

namespace NinetyNineDesigns\PhpCodingTest\model;

class FileIO
{
    const READ_MODE = 'r';
    const CHUNK_SIZE = 1024*1024;

    /**
     * @param $path
     * @return array
     */
    public function readFile($path)
    {
        $handle = fopen($path, self::READ_MODE);
        $chunk_size = self::CHUNK_SIZE;

        $chunks = [];

        if ($handle) {
            while (!feof($handle)) {
                $chunks[] = fread($handle, $chunk_size);
            }
            fclose($handle);
        }

        return $chunks;
    }
}