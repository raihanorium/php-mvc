<?php
/**
 * Created by PhpStorm.
 * User: ataul.raihan
 * Date: 1/4/2017
 * Time: 11:33 PM
 */

namespace services;


class LoggerService {
    private $fileName;

    private function __construct(){
        $this->fileName = 'file_log.txt';
    }

    public static function Instance(){
        static $inst = null;
        if ($inst === null) {
            $inst = new LoggerService();
        }
        return $inst;
    }

    public function fileLog($data){
        file_put_contents($this->fileName, $data, FILE_APPEND);
        file_put_contents($this->fileName, "\r\n", FILE_APPEND);
    }
}