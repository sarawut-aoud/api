<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Activity_model extends Model
{

    public function __construct()
    {
    }
    public function get_activity()
    {
        $result = DB::select("SELECT t1.class as id ,t1.emp ,t2.name ,t1.id as pd_id
                                FROM db_table.employee t1
                                LEFT JOIN db_table.activity t2 ON t1.class = t2.id
                                WHERE t1.status_show = 'active'");

        $data = [];
        foreach ($result  as $key => $val) {
            $data[$key]['class'] = $val->id;
            $data[$key]['name'] = $val->name;
            $data[$key]['emp'] = $val->emp;
            $data[$key]['pd_id'] = Crypt::encrypt($val->pd_id);
        }
        return $data;
    }
    public function activity()
    {
        $result = DB::select("SELECT * 
                               FROM db_table.activity t2  WHERE listrow = 1
                               ");

        $data = [];
        foreach ($result  as $key => $val) {
            $data[$key]['id'] = $val->id;
            $data[$key]['name'] = $val->name;
        }
        return $data;
    }
    public function update_activity($post)
    {
        $emp = self::get_activity();
        $max = count(self::activity());
        if ($post->pass == '0979284920') {
            foreach ($emp  as $key => $val) {
                $val = (object)$val;
                if ($max ==  $val->class) {
                    $class  = 1;
                } else {
                    $class = $val->class + 1;
                }
                DB::table('db_table.employee')
                    ->where('id', Crypt::decrypt($val->pd_id))
                    ->update(['class' => $class]);
            }
            return true;
        } else {
            return false;
        }
    }
}
