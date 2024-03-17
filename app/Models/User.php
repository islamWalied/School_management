<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_type',
        'parent_id',
        'password',
        'last_name',
        'admission_number',
        'admission_date',
        'roll_number',
        'class_model_id',
        'gender',
        'status',
        'religion',
        'date_of_birth',
        'phone_number',
        'occupation',
        'address',
        'image',
        'blood_group',
        'height',
        'weight',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getEmailSingle($email)
    {
        return self::where('email',$email)->first();
    }
    public static function getAdmin()
    {
        $return = self::select('users.*')->where('user_type','admin')->where('deleted_at',null);
        if (!empty(Request::get('email')))
        {
            $return = $return->where('email','like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('name')))
        {
            $return = $return->where('name','like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date')))
        {
            $return = $return->where('created_at','like', '%' . Request::get('date') . '%');
        }
        $return = $return->orderBy('id','desc')->paginate(10);
        return $return;
    }
    public static function getUser($id)
    {
        return self::findOrFail($id);
    }
    public static function getTokenSingle($remember_token)
    {
        return self::where('remember_token',$remember_token)->first();
    }
    public static function getStudent()
    {
        $return =  self::select('users.*', 'class_models.name as class_name','parent.name as parent_name','parent.last_name as parent_last_name')
            ->join('users as parent','parent.id', '=','users.parent_id','left')
            ->join('class_models','class_models.id','users.class_model_id','left')
                    ->where('users.user_type','student')
                    ->where('users.deleted_at',null);
        return self::extracted($return);
    }
    public static function getParents()
    {
        $return =  self::select('users.*')
            ->where('user_type','parents')
            ->where('users.deleted_at',null);

        return self::extracted($return);
    }
    public static function getMyStudents($parent_id)
    {
            $return =  self::select('users.*', 'class_models.name as class_name','parent.name as parent_name')
                ->join('users as parent','parent.id', '=','users.parent_id','left')
                ->join('class_models','class_models.id', '=','users.class_model_id','left')
                ->where('users.user_type','student')
                ->where('users.parent_id',$parent_id)
                ->where('users.deleted_at',null)
                ->orderBy('users.id', 'desc')
            ->get();
            return $return;
    }
    public static function getSearchStudents()
    {
        if (!empty(Request::get('student_id')) || !empty(Request::get('name'))
            || !empty(Request::get('last_name')) || !empty(Request::get('email')))
        {
            $return =  self::select('users.*', 'class_models.name as class_name','parent.name as parent_name')
                ->join('users as parent','parent.id','=','users.parent_id','left')
                ->join('class_models','class_models.id','users.class_model_id','left')
                ->where('users.user_type','student')
                ->where('users.deleted_at',null);
            if (!empty(Request::get('student_id'))) {
                $return = $return->where('users.id','=',Request::get('student_id'));
            }
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'LIKE', '%' . Request::get('name') . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.name', 'LIKE', '%' . Request::get('name') . '%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'LIKE', '%' . Request::get('email') . '%');
            }
            $return = $return->orderBy('users.id', 'desc')
                ->paginate(10);
            return $return;
        }
    }
    /**
     * @param $return
     * @return mixed
     */
    public static function extracted($return)
    {
        if (!empty(Request::get('student_id'))) {
            $return = $return->where('users.id','=',Request::get('student_id'));
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'LIKE', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('religion'))) {
            $return = $return->where('users.religion', 'LIKE', '%' . Request::get('religion') . '%');
        }
        if (!empty(Request::get('date_of_birth'))) {
            $return = $return->where('users.date_of_birth', 'LIKE', '%' . Request::get('date_of_birth') . '%');
        }
        if (!empty(Request::get('height'))) {
            $return = $return->where('users.height', 'LIKE', '%' . Request::get('height') . '%');
        }
        if (!empty(Request::get('blood_group'))) {
            $return = $return->where('users.blood_group', 'LIKE', '%' . Request::get('blood_group') . '%');
        }
        if (!empty(Request::get('status'))) {
            $return = $return->where('users.status', 'Like', Request::get('status'));
        }
        if (!empty(Request::get('weight'))) {
            $return = $return->where('users.weight', 'LIKE', '%' . Request::get('weight') . '%');
        }
        if (!empty(Request::get('phone_number'))) {
            $return = $return->where('users.phone_number', 'LIKE', '%' . Request::get('phone_number') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', 'LIKE', '%' . Request::get('gender') . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $return = $return->where('users.roll_number', 'LIKE', '%' . Request::get('roll_number') . '%');
        }
        if (!empty(Request::get('admission_number'))) {
            $return = $return->where('users.admission_number', 'LIKE', '%' . Request::get('admission_number') . '%');
        }
        if (!empty(Request::get('admission_date'))) {
            $return = $return->where('users.admission_date', 'LIKE', '%' . Request::get('admission_date') . '%');
        }
        if (!empty(Request::get('class_model_id'))) {
            $return = $return->where('class_models.name', 'LIKE', '%' . Request::get('class_model_id') . '%');
        }


        $return = $return->orderBy('users.id', 'desc')
            ->paginate(10);
        return $return;
    }
}
