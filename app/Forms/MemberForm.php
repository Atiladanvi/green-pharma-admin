<?php

namespace App\Forms;

use App\Models\User;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;
use Spatie\Permission\Models\Role;

class MemberForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|min:5|max:150',
                'attr' => ['class' => 'form-control']
            ])
            ->add('role', Field::TEXT, [
                'attr' => ['class' => 'form-control', 'disabled' => true],
                'default_value' => User::$ANALISTA
            ])
            ->add('email', Field::EMAIL, [
                'rules' => 'required|email',
                'attr' => ['class' => 'form-control']
            ])
            ->add('password', Field::PASSWORD, [
                'rules' => 'required|string|min:6|max:255|confirmed',
                'attr' => ['class' => 'form-control']
            ])
            ->add('password_confirmation', Field::PASSWORD, [
                'rules' => 'required|string|min:6|max:255,confirmation',
                'attr' => ['class' => 'form-control']
            ])
            ->add('Save', Field::BUTTON_SUBMIT, [
                'attr' => ['class' => 'btn-primary btn']
            ]);
    }

}
