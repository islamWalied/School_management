<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class ClassSubject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_model_id',
        'subject_id',
        'created_by',
        'status',
    ];

    public static function getRecord()
    {
        $return = self::select('class_subjects.*','class_models.name as class_name',
                            'subjects.name as subject_name','users.name as created_by_name')
                        ->join('subjects','subjects.id','class_subjects.subject_id')
                        ->join('class_models','class_models.id','class_subjects.class_model_id')
                        ->join('users','users.id','class_subjects.created_by');
                    if (!empty(Request::get('class_name')))
                    {
                        $return = $return->where('class_models.name','like', '%' . Request::get('class_name') . '%');
                    }
                    if (!empty(Request::get('subject_name')))
                    {
                        $return = $return->where('subjects.name','like', '%' . Request::get('subject_name') . '%');
                    }
                    if (!empty(Request::get('date')))
                    {
                        $return = $return->where('class_subjects.created_at','like', '%' . Request::get('date') . '%');
                    }
            $return  = $return->orderBy('class_subjects.id','desc')
                        ->paginate(10);
        return $return;

    }
    public static function getAlreadyFirst($class_id,$subject_id)
    {
        return self::where('class_model_id','=',$class_id)->where('subject_id','=',$subject_id)->first();
    }

    public static function getAssignSubjectID($class_id)
    {
        return self::where('class_model_id',$class_id)->where('deleted_at',null)->get();
    }
    public static function deleteSubject($class_id)
    {
        return self::where('class_model_id',$class_id)->delete();
    }
}
