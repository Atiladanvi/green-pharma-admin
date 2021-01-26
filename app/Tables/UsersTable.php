<?php

namespace App\Tables;

use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UsersTable extends AbstractTable
{
    protected function table(): Table
    {
        return (new Table())->model(User::class)
            ->routes([
                'index' => ['name' => 'user.index'],
                'edit' => ['name' => 'user.edit'],
                'destroy' => ['name' => 'user.destroy'],
            ])->disableRows(function(User $user) {
                 return $user->id === auth()->id();
            },['bg-danger', 'text-primary']);
    }

    protected function columns(Table $table): void
    {
        $table->column('id')->sortable(true)->title('ID');
        $table->column('name')->sortable()->searchable()->title('Name');
        $table->column('role')->title('Role');
        $table->column('email')->sortable()->searchable()->title('E-mail');
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable()->title('Created at');
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable()->title('Updated at');;
    }
}
