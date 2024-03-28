<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\ActivityLog;
use App\Models\SubscriberLog;


/**
 *
 * \----------------------------------------------------------------------------------------------------------------------------
 * @profile: <app/GlobalModel.php>
 * @description: Handles the model side for 'GlobalModel' data.
 * @author: Roldan Torralba
 * /----------------------------------------------------------------------------------------------------------------------------
 *
 */
class GlobalModel extends Model{

    public static function getLastInsertId() {
        return DB::getPdo()->lastInsertId();
    }

    public static function getNextID($table) {
        $sqlStr = " SHOW TABLE STATUS LIKE '$table' ";
        $res    = DB::select($sqlStr);

        $data = 0;
        if ($res && count($res) > 0 ) {
            $data = $res[0]->Auto_increment;
        }
        return $data;
    }

    public static function getNextMID($table) {
        $sqlStr = "SELECT COUNT(MONTH(CURDATE())) AS i FROM $table ";
        $res    = DB::select($sqlStr);
        return ($res[0]->i+1);
    }   

    public static function getNextRefNo() {
        $response = 'error';
        $now = date('Y-m-d H:i:s');
        $data['ref_no']  = str_pad(GlobalModel::getNextID('bm_sales_ref_no'), 6, '0', STR_PAD_LEFT).'-'.time();
        $data['status'] = 1;
        $data['created_dt'] = $now;
        $data['created_by'] = Auth::user()->emp_id;

        $result = DB::table('bm_sales_ref_no')->insert($data);
        if ($result) {
           $response = $data['ref_no'];
        }
        return $response;
    }

    public static function getTableList($table,$where_arr='',$limit=0, $order='') {
        $result = DB::table($table)->select('*');
        if($where_arr!='') {
            $result->where($where_arr);
        }
        if($limit!=0) {
            $result->limit($limit);
        }
        if($order!='') {
            $result->orderByRaw($order);
        } else {
            $result->orderByRaw('id DESC');
        }
        return $result->get();
    }

    public static function getTableData($table,$where_arr) {
        $result = DB::table($table)->select('*')->where($where_arr)->orderByRaw('id DESC');
        return $result->first();
    }

    public static function isAddExistData($table,$field,$data) {
        $result = DB::table($table)->where($field, '=', $data)->where($field, '!=', '');
        return $result->exists();
    }

    public static function isEditExistData($table,$field,$new_data,$old_data) {
        $result =  DB::table($table)->where($field, 'LIKE', $new_data)->where($field, 'NOT LIKE', $old_data)->where($field, '!=', '');
        return $result->exists();
    }

    public static function insertTableData($table,$data) {
        return DB::table($table)->insert($data);
    }

    public static function updateTableField($table,$data,$where_arr) {
        return DB::table($table)->where($where_arr)->update($data);
    }

    public static function deleteTableData($table,$field,$data) {
        return DB::table($table)->where($field, '=', $data)->delete();
    }

    //Subscriber Task
    public static function logSubscriber($table,$id,$task)
    {
        $log['table']       = $table;
        $log['table_id']    = $id;
        $log['task']        = $task;
        $log['created_by']  = session('userdata')->id;
        $result = SubscriberLog::create($log);
    }

    //Log Task
    public static function logTask($task,$details)
    {
        $log['task']        = $task;
        $log['details']     = $details;
        $log['ip']          = request()->ip();
        $log['browser']     = request()->header('User-Agent');
        $log['status']      = 1;
        $log['created_by']  = (session('userdata'))?session('userdata')->id:0;
        $result = ActivityLog::create($log);
    }

}
