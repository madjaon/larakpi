<?php 
namespace App\Helpers;

use DB;

class CommonQuery
{
    /**
     * lay gia tri 1 cot theo ID
     * @param  [type] $table         [description]
     * @param  [type] $id            [description]
     * @param  [type] $col           1 cot
     * @param  [type] $colIsNumber   neu null, tra ve 0
     * @return [type]                [description]
     */
    static function getNameById($table, $id)
    {
        $data = DB::table($table)->where('id', $id);
        $data = $data->first();
        if(isset($data)) {
            return $data->name;
        }
        return '';
    }

    /**
     * lay 1 mang id,name cua 1 table
     * @param  [type] $table [description]
     * @return [type]        [description]
     */
    static function getArrayIdName($table)
    {
        $data = DB::table($table)->pluck('name', 'id');
        if(!empty($data)) {
            return $data;
        }
        return null;
    }

    /**
     * get a Collection by ID
     * @param  [type] $table  [description]
     * @param  [type] $id     [description]
     * @param  [type] $cols   1 hoac nhieu cot
     * @return [type]         collection or null
     */
    static function getDataById($table, $id)
    {
        $data = DB::table($table)->where('id', $id)->first();
        if(!empty($data)) {
            return $data;
        }
        return null;
    }
    
    /**
     * lay 1 mang gia tri cua 1 cot
     * @param  [type] $table [description]
     * @param  [type] $col [description]
     * @return [type]        [description]
     */
    static function getArrayCol($table, $col)
    {
        $data = DB::table($table)->select($col)->groupBy($col)->lists($col, $col);
        if(!empty($data)) {
            return $data;
        }
        return null;
    }

}