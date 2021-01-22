<?php

namespace App\Tables;

use Octo\Resources\Objects\Column;
use Octo\Resources\Objects\Table;

class UserTable extends Table
{
    public function builder()
    {
        $this
            ->add('Name', 'name', Column::TEXT)
            ->add('Email', 'email', Column::TEXT)
            ->add('Role', 'role', Column::TEXT)
            ->add('Created at', 'created_at')
            ->add('Updated at', 'updated_at');
    }
}
