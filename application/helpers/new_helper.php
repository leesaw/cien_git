<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function check_task($var)
    {
        if ($var==1) $result = '<span class="label label-info">Processing</span>';
        else if ($var==2) $result = '<span class="label label-success">Finished</span>';
        else if ($var==0) $result = '<span class="label label-warning">Waiting</span>';
        return $result;
    }  
    
    function check_out($var)
    {
        if ($var==1) $result = '<span class="badge bg-green"><i class="fa fa-check"></i>&nbsp;&nbsp;ใช้ได้</span>';
        else if ($var==2) $result = '<span class="badge bg-red"><i class="fa fa-times"></i>&nbsp;&nbsp;ใช้ไม่ได้</span>';
        else if ($var==0) $result = '<span class="badge bg-blue"><i class="fa fa-coffee"></i>&nbsp;&nbsp;Waiting</span>';
        else if ($var==3) $result = '<span class="badge bg-yellow"><i class="fa fa-gear"></i>&nbsp;&nbsp;ซ่อม</span>';
        else if ($var==4) $result = '<span class="badge bg-purple"><i class="fa fa-rotate-left"></i>&nbsp;&nbsp;วัตถุดิบไม่เหมาะสม</span>';
        else if ($var==5) $result = '<span class="badge bg-navy"><i class="fa fa-rotate-left"></i>&nbsp;&nbsp;คืนวัตถุดิบ</span>';
        return $result;
    } 
}