<?php

class File_helper
{
    private $file;

    function __construct()
    {
        $filename   = "/etc/hosts.allow";
        $this->file = fopen($filename, "r+");
    }

    function __destruct()
    {
       fclose($this->file);
    }

    public function read()
    {
        if($this->file)
        {
            $data = array();
            while($line = fgets($this->file))
            {
                if(substr($line, 0, 1) == '#')
                {
                    $row['comment'] = ltrim($line, '#');
                    $row['comment'] = str_replace(PHP_EOL, '', $row['comment']);
                }
                else
                {
                    list($row['daemon'], $row['access_list'], $row['action']) = explode(':', $line);
                    $row['action']      = str_replace(PHP_EOL, '',  $row['action']);
                    $row['access_list'] = trim($row['access_list']);
                    $row['action']      = trim($row['action']);
                    $data[]             = $row;
                    $row['comment']     = '';
                }
            }
            return $data;
        }
        else
            die("error opening file");
    }

    public function write($data)
    {
        ftruncate($this->file, 0);
        foreach ($data as $row)
            fwrite($this->file, '#'.$row['comment'].PHP_EOL.$row['daemon'].': '.$row['access_list'].': '.$row['action'].PHP_EOL);
    }
}