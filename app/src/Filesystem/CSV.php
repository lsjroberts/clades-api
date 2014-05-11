<?php namespace Clades\Filesystem;

use File;
use InvalidArgumentException;

class CSV
{
    public static function read($path)
    {
        $rows = [];

        if (! File::isFile($path))
        {
            throw new InvalidArgumentException(sprintf('File does not exist at %s', $path));
        }

        $handle = fopen($path, 'r');
        $columns = null;
        while (($row = fgetcsv($handle)) !== false)
        {
            if (! $columns)
            {
                $columns = $row;
            }
            else
            {
                $rows[] = array_combine($columns, $row);
            }
        }
        fclose($handle);

        return $rows;
    }
}