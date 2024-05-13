<?php

namespace App\Imports;

use App\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class InventoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inventory([
            'p_name' => $row['p_name'],
            'p_owner' => $row['p_owner'],
            'Country' => $row['Country'],
            'total_budget' => $row['total_budget'],
            'get_budget'=> $row['get_budget'],
            'ramain_budget'=> $row['ramain_budget'],
            'start_time'=> $row['start_time'],
            'deadline'=> $row['deadline'],
            'meeting'=> $row['meeting'],
            // 'type'=> $row['type'],
            'category_id'=> $row['category_id'],
            // 'tax_id'=> $row['tax_id'],
            'user_id'=>Auth::user()->id
        ]);
    }
}
