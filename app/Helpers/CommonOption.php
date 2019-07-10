<?php 
namespace App\Helpers;

use DB;

class CommonOption
{
    static function trendArray()
    {
        return array(1 => 'Tăng', 2 => 'Giảm');
    }
    static function getTrend($key = 1)
    {
        if(!isset($key)) return;
        else $key = $key;
        $array = self::trendArray();
        return $array[$key];
    }

    static function getScore($perPerform = 0)
    {
        if($perPerform >= 120) {
            $score = 5;
        } elseif($perPerform < 120 && $perPerform >= 110) {
            $score = 4;
        } elseif($perPerform < 110 && $perPerform >= 100) {
            $score = 3;
        } elseif($perPerform < 100 && $perPerform >= 90) {
            $score = 2;
        } elseif($perPerform < 90 && $perPerform >= 80) {
            $score = 1;
        } else {
            $score = 0;
        }
        return $score;
    }

    // diem -> hieu suat
    static function getEfficiency($score = 0)
    {
        switch ($score) {
            case 0:
                $efficiency = 70;
                break;
            case 1:
                $efficiency = 80;
                break;
            case 2:
                $efficiency = 90;
                break;
            case 3:
                $efficiency = 100;
                break;
            case 4:
                $efficiency = 110;
                break;
            case 5:
                $efficiency = 120;
                break;
            
            default:
                $efficiency = 120;
                break;
        }
        return $efficiency;
    }

    static function getRank($key)
    {
        if(!isset($key)) return;
        $array = self::rankArray();
        return $array[$key];
    }

    static function rankArray()
    {
        return array(
            0 => 'Rất kém', 
            1 => 'Kém',
            2 => 'Yếu',
            3 => 'Đạt',
            4 => 'Giỏi',
            5 => 'Xuất sắc'
        );
    }

}
