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
        return self::select('users.*', 'class_models.name as class_name')
            ->join('class_models','class_models.id','users.class_model_id','left')
                    ->where('user_type','student')
                    ->where('users.deleted_at',null)
                    ->orderBy('id','desc')
                    ->paginate(10);
    }
}
