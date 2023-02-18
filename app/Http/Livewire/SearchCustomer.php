<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class SearchCustomer extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchTerm;
    public $filters = [];
    public $perPage = 20;
    public $sort = 'created_at|desc';
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $field;

    /*
     * Reset pagination when doing a searchTerm
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $customers = Customer::with('products')->withCount('products');
        
        $this->applySearchFilter($customers->orderBy($this->sortColumnName, $this->sortDirection));


        $customers = $customers->orderBy($this->sortByColumn(), $this->sortDirection())
            ->paginate($this->perPage);

        return view('livewire.search-customer', [
            'customers' => $customers,
        ]);
    }

    public function updateOrder($list) {

        foreach($list as $item) {

            Customer::find((int)$item['value'])->update(['id' => (int)$item['order']]) ;
        }


    }


    public function sortByColumn()
    {
        $sort = explode("|", $this->sort);

        if (!$sort[0]) {
            return;
        }

        return $sort[0];
    }

    public function sortDirection()
    {
        $sort = explode("|", $this->sort);

        return $sort[1] ?? 'asc';
    }

    private function applySearchFilter($customers)
    {
        if ($this->searchTerm) {
            return $customers->whereRaw("billing_name LIKE \"%$this->searchTerm%\"")
                ->orWhereRaw("billing_surname LIKE \"%$this->searchTerm%\"")
                ->orWhereRaw("email LIKE \"%$this->searchTerm%\"");

        }

        return null;
    }


    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
}
