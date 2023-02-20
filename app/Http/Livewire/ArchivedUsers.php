<?php

namespace App\Http\Livewire;

use App\Models\ArchivedUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ArchivedUsers extends Component
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

        $archivedUsers = ArchivedUser::with('products')->withCount('products');

        $this->applySearchFilter($archivedUsers->orderBy($this->sortColumnName, $this->sortDirection));


        $archivedUsers = $archivedUsers->orderBy($this->sortByColumn(), $this->sortDirection())
            ->paginate($this->perPage);

        return view('livewire.archived-users', [
            'archivedUsers' => $archivedUsers,
        ]);
    }

    public function updateOrder($list) {

        foreach($list as $user) {

            User::find((int)$user['value'])->update(['id' => (int)$user['name']]) ;
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

    private function applySearchFilter($archivedUsers)
    {
        if ($this->searchTerm) {
            return $archivedUsers->whereRaw("name LIKE \"%$this->searchTerm%\"")
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
