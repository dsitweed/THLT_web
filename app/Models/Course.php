<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    public function scopeFilter($query, array $filter){
        if($filter['tag'] ?? false){
            // dd($query);
            $query->where('tag','like','%'.request('tag').'%');
            // apply
        }

        if($filter['search'] ?? false){
            // dd($query);
            // Find the teacher by name => user_id => teacher_id => course
            // DB::class return a delequent model Collection
            $userIdByName = DB::table("users")->select('id')->where('name','like','%'.request('search').'%')->get()->first();//get user_id from users table
            if(isset($userIdByName)){
                $teacherIdByUserId = DB::table("teachers")->select('id')->where('user_id','like','%'.$userIdByName->id.'%')->get()->first();
                $query->where('teacher_id','like','%'.$teacherIdByUserId->id.'%');
                // print_r($userIdByName);
                // print_r($teacherIdByUserId);
            }else{
                $query->where('name','like','%'.request('search').'%')
                ->orWhere('description','like','%'.request('search').'%')
                ->orWhere('tag','like','%'.request('search').'%');            
            }
            // apply
        }
    }
}
