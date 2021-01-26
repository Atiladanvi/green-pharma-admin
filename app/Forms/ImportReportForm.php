<?php

namespace App\Forms;

use App\Models\SalesMonth;
use App\Models\Warehouse;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ImportReportForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('tipo', Field::SELECT, [
                'choices' => [
                    SalesMonth::$TYPE_QUANTITY => 'Quantidade Vendida',
                    SalesMonth::$TYPE_VALUE => 'Valor vendido',
                ],
                'rules' => 'required',
                'label' => 'Tipo de relatório',
                'empty_value' => '=== Selecione um tipo ===',
                'attr' => ['class' => 'form-control']
            ])
            ->add('unidade', Field::SELECT, [
                'choices' => Warehouse::all()
                    ->pluck('name', 'id')
                    ->toArray(),
                'rules' => 'required',
                'empty_value' => '=== Selecione uma unidade ===',
                'label' => 'Unidade',
                'attr' => ['class' => 'form-control']
            ])
            ->add('file', Field::FILE, [
                'rules' => 'required|max:1000|mimes:xlsx',
                'label' => 'Arquivo *XLSX',
                'wrapper' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control-file']
            ])
            ->add('Import', Field::BUTTON_SUBMIT, [
                'attr' => ['class' => 'btn-primary btn']
            ]);
    }

}
