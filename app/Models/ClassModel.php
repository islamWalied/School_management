<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class ClassModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'created_by',
    ];
    public static function getClasses()
    {
        $return = self::select('class_models.*','users.name as created_by_name')->join('users','users.id','class_models.created_by')->where('class_models.deleted_at',null);
        if (!empty(Request::get('class_name')))
        {
            $return = $return->where('class_models.name','like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('status')))
        {
            $return = $return->where('status','like', '%' . Request::get('status') . '%');
        }
        $return = $return->orderBy('id','desc')->paginate(10);
        return $return;
    }
}
