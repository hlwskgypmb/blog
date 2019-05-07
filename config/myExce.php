<?php
use Exception;
use think\exception\Handle;

class myExce extends Handle
{

    public function render(Exception $e)
    {
        return toJson(500,$e->getMessage());
    }

}