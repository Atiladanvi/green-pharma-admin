<?php

namespace App\Forms;

use App\Models\SalesMonth;
use App\Models\Warehouse;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ExportReportForm extends Form
{
    public function buildForm()
    {
        $this->add('filter', Field::HIDDEN, [
                'value' => 'true'
            ])
            ->add('tipo', Field::SELECT, [
                'choices' => [
                    SalesMonth::$TYPE_QUANTITY => 'Quantidade Vendida',
                    SalesMonth::$TYPE_VALUE => 'Valor vendido',
                ],
                'rules' => 'required',
                'label' => 'Tipo de relatório',
                'empty_value' => '=== Selecione um tipo ==='
            ])
            ->add('fornecedor', Field::SELECT, [
                'choices' =>  SalesMonth::query()
                    ->groupBy('fornecedor')
                    ->pluck('fornecedor', 'fornecedor')
                    ->toArray(),
                'rules' => 'required',
                'empty_value' => '=== Selecione uma indústria ===',
                'label' => 'Indústria'
            ])
            ->add('unidade', Field::SELECT, [
                'choices' => Warehouse::all()
                    ->pluck('name', 'id')
                    ->toArray(),
                'rules' => 'required',
                'empty_value' => '=== Selecione uma unidade ===',
                'label' => 'Unidade'
            ])
            ->add('data_inicial', Field::DATE, [
                'label' => 'Data Inicial',
                'rules' => 'required'
            ])
            ->add('data_final', Field::DATE, [
                'label' => 'Data Final',
                'rules' => 'required',
            ])
            ->add('Apply filters', Field::BUTTON_SUBMIT, [
                'attr' => ['class' => 'btn-primary btn']
            ]);
    }

}
