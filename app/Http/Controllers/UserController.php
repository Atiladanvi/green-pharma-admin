<?php

namespace App\Http\Controllers;

use App\CreateUser ;
use App\Forms\UserCreateForm;
use App\Forms\MemberEditForm;
use App\Models\User;
use App\Tables\UsersTable;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $user;

    public function __construct(CreateUser $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $table = (new UsersTable())->setup();

        return view('user.index')->with(compact('table'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserCreateForm::class, [
            'method' => 'POST',
            'url' => route('user.store')
        ]);

        return view('user.create', compact('form'));
    }

    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserCreateForm::class);

        $data = $form->getFieldValues();

        if (!$form->isValid())   {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $this->user->create($data, Role::findByName(User::$ANALYST));

        return redirect(route('user.index'));
    }

    public function show($id)
    {

    }

    public function edit($id, FormBuilder $formBuilder)
    {
        $user = User::find($id);

        $form = $formBuilder->create(MemberEditForm::class, [
            'method' => 'PUT',
            'url' => route('user.update', [$user->id]),
            'model' => $user->toArray()
        ]);

        return view('user.edit')->with(['user' => $user , 'form' => $form]);

    }

    public function update(Request $request, $id)
    {
        return redirect(route('user.index'));
    }

    public function destroy($id)
    {
        return redirect(route('user.index'));
    }
}
