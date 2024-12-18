<?php

namespace App\Exports;

use App\Models\Group;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    private Group $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function headings(): array
    {
        return [
            'Фамилия',
            'Имя',
            'Отчество',
            'Дата рождения',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this
            ->group
            ->students()
            ->orderBy('last_name')
            ->get(['last_name', 'first_name', 'middle_name', 'birthday']);
    }
}
