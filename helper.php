<?php

/**
* Helper function
*/
class Helper
{

    function __construct()
    {
        # code...
    }

    public function minify($string)
    {
        $string = str_replace(array("\r\n", "\r"), "\n", $string);
        $lines = explode("\n", $string);
        $new_lines = array();

        foreach ($lines as $i => $line) {
            if (!empty($line))
                $new_lines[] = trim($line);
        }
        return implode($new_lines);
    }
}