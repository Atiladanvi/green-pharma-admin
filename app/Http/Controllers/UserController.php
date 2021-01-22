<?php

namespace App\Http\Controllers;

use App\Forms\MemberForm;
use App\Models\User;
use App\Tables\UserTable;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;
use Octo\Resources\Builders\TableBuilder;

class UserController extends Controller
{
    public function index(TableBuilder $tableBuilder)
    {
        $users = User::query()
            ->paginate(15);

        $table = $tableBuilder->create(UserTable::class, $users)->build();

        return view('member.index')->with(compact('table'));
    }

    public function create(FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(MemberForm::class, [
            'method' => 'POST',
            'url' => route('member.store')
        ]);

        return view('member.create', compact('form'));
    }

    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(MemberForm::class);

        $data = $form->getFieldValues();

        if (!$form->isValid())   {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->user = User::create([
            'tenant_id' => tenant()->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $this->user->assignRole(User::$ANALISTA);

        return redirect(route('member.index'));
    }

    public function show($id)
    {

    }

    public function edit($id, FormBuilder $formBuilder)
    {
        $user = User::find($id);

        $form = $formBuilder->create(\App\Forms\MemberForm::class, [
            'method' => 'PUT',
            'url' => route('member.update', [$user->id]),
            'model' => $user->toArray()
        ]);

        return view('member.edit')->with(['member' => $user , 'form' => $form]);

    }

    public function update(Request $request, $id)
    {
        return redirect(route('member.index'));
    }

    public function destroy($id)
    {
        return redirect(route('member.index'));
    }
}
