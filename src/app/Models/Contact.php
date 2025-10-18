<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function contacts()
    {
        return $this->belongsTo(Contact::class);
    }

    public function scopeKeywordSearch($query, $request)
    {
        $keyword = $request->input('keyword');
        $gender = $request->input('gender');
        $categoryId = $request->input('category_id');
        $date = $request->input('date');

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'like', '%' . $keyword . '%')
                ->orWhere('last_name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        if (!empty($gender)) {
            if ( $gender == 4){
                $query;
            } else {
            $query->where('gender',$gender);
            }
        }
        if (!empty($categoryId)) {
            $query->where('category_id',$categoryId);
        }
        if (!empty($date)) {
            $query->whereDate('created_at',$date);
        }
        if (empty($keyword) && empty($gender) && empty($categoryID) && empty($date)) {
            $query ;
        }

        return $query;
    }
}
