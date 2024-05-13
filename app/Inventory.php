<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class Inventory extends Model
{
    use UseUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'p_name',
        'p_owner',
        'Country',
        'total_budget',
        'get_budget',
        'ramain_budget',
        'start_time',
        'deadline',
        'meeting',
        'category_id',
        'user_id',

    ];

    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function category($id)
    {
        $categoryId = Inventory::where('id', $id)->first()->category_id;
        return Category::where('id', $categoryId)->first()->name;
    }
}
