<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'parent',
        'meta_title',
        'meta_description',
        'image'
    ];

    public static function getValidationRules($is_image=false,$id=NULL)
    {
        return
            [
                'title' => ['required','unique:categories,title'.(($id!=NULL) ? ", " . $id : ""), 'max:255'],
                'name'  => ['required','unique:categories,name'.(($id!=NULL) ? ", " . $id : ""),'max:255'],
                'image' => ($is_image) ? ['image'] : '',
            ];

    }
}
