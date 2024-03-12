<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Subject extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'subject_type',
    ];
    public static function getSubjects()
    {
        $return = self::select('subjects.*','users.name as created_by_name')->join('users','users.id','subjects.created_by')->where('subjects.deleted_at',null);
        if (!empty(Request::get('subject_name')))
        {
            $return = $return->where('subjects.name','like', '%' . Request::get('subject_name') . '%');
        }
        if (!empty(Request::get('subject_type')))
        {
            $return = $return->where('subject_type','like', '%' . Request::get('subject_type') . '%');
        }
        if (!empty(Request::get('status')))
        {
            $return = $return->where('status','like', '%' . Request::get('status') . '%');
        }

        $return = $return->orderBy('id','desc')->paginate(10);
        return $return;
    }
    public static function getSubject()
    {
        return self::select('subjects.*','users.name as created_by_name')
                            ->join('users','users.id','subjects.created_by')
                            ->where('subjects.status','active')
                            ->where('subjects.deleted_at',null)
                            ->orderBy('subjects.name','desc')->paginate(10);

    }
}
