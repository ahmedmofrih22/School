<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];


    // علاقة بين الطلاب والمراحل الدراسية لجلب اسم المرحلة في جدول المواد

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول المواد

    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id');
    }

    // علاقة بين المدرسين المواد لجلب اسم المدرس في جدول المواد

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }
}
