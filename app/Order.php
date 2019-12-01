<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable =[
        'program_id',
        'user_id',
        'name',
        'status',
        'age',
        'gender',
        'weight',
        'tall',
        'health_diseases',
        'subscription_goals_id',
        'sports_levels_id',
        'sports_types_id',
        'fats_area_id',
        'meals_number',
        'image',
        'food_allergy',
        'medicine_status',
        'medicine_name',
        'right_arm',
        'left_arm',
        'chest',
        'buttocks',
        'belly',
        'right_thigh',
        'left_thigh',
        'start_date',
        'end_date',
        'cost',
        'period',
    ];
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
