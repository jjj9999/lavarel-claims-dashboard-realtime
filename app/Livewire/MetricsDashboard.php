<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class MetricsDashboard extends Component
{
    use WithPagination;

    public $history = [];
    public $sortField = 'timestamp';
    public $sortDirection = 'desc';
    public $page = 1; // Needed property for pagination
    public $search = '';


    protected $listeners = ['dataRefreshed' => 'addToHistory'];

    public function addToHistory($data)
    {
        $this->history[] = array_merge(
            $data,
            [
                'timestamp' => now()->format('H:i:s'),
                'date' => now()->toDateString(), // Adds YYYY-MM-DD
            ]
        );
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage(); // reset to first page on sort
    }

    public function getPaginatedHistoryProperty()
    {
        $filtered = collect($this->history)
            ->filter(function ($item) {
                $query = strtolower($this->search);

                return str_contains(strtolower(json_encode($item)), $query);
            })
            ->sortBy([
                [$this->sortField, $this->sortDirection]
            ])
            ->values();

        return $filtered->forPage($this->page, 5);
    }

    public function resetPage()
    {
        $this->page = 1;
    }

    public function nextPage()
    {
        if (count($this->paginatedHistory) === 5) {
            $this->page++;
        }
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function render()
    {
        return view('livewire.metrics-dashboard', [
            'rows' => $this->paginatedHistory,
        ]);
    }
}
