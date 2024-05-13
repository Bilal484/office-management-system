<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IInventoryRepository;
use Illuminate\Http\Request;
use App\Inventory;
use Auth;

class InventoryRepository implements IInventoryRepository
{
    protected $inventories;

    public function __construct(Inventory $inventories)
    {
        $this->inventories = $inventories;
    }

    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
        return $this->inventories
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getNameById($id)
    {
        return $this->inventories->where('id', $id)->first()->name;
    }

    public function store(Request $request, $file_name)
    {
        $inventory = $this->inventories;
        $inventory->p_name = $request->p_name;
        $inventory->p_owner = $request->p_owner;
        $inventory->Country = $request->Country;
        $inventory->total_budget = $request->total_budget;
        $inventory->get_budget = $request->get_budget;
        $inventory->ramain_budget = $request->ramain_budget;
        $inventory->start_time = $request->start_time;
        $inventory->deadline = $request->deadline;
        $inventory->meeting = $request->meeting;
        $inventory->category_id = $request->category;
        // $inventory->tax_id = $request->tax;
        // $inventory->quantity = $request->inventory;
        // $inventory->type = $request->type;
        $inventory->user_id = Auth::user()->id;
        return [
            'result' => $inventory->save(),
        ];
    }

    public function getById($id)
    {
        return $this->inventories->where('id', $id)->get();
    }

    public function update(Request $request, $file_name, $id)
    {
        $inventory = $this->inventories->find($id);
        $inventory->p_name = $request->p_name;
        $inventory->p_owner = $request->p_owner;
        $inventory->Country = $request->Country;
        $inventory->total_budget = $request->total_budget;

        $inventory->get_budget = $request->get_budget;
        $inventory->ramain_budget = $request->ramain_budget;
        $inventory->start_time = $request->start_time;
        $inventory->deadline = $request->deadline;
        $inventory->meeting = $request->meeting;
        $inventory->category_id = $request->category;
        // $inventory->tax_id = $request->tax;
        // $inventory->quantity = $request->inventory;
        // $inventory->type = $request->type;
        return [
            'result' => $inventory->save()
        ];
    }

    public function destroy($id)
    {
        return $this->inventories->destroy($id);
    }
    


    public function getQuantity($id)
    {
        return $this->inventories->where('id', $id)->first()->quantity;
    }

    public function updateQuantity($id, $quantity)
    {
        $inventories = $this->inventories->find($id);
        $inventories->quantity = $quantity;
        $inventories->save();
        return $inventories;
    }
}
