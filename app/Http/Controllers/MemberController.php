<?php

namespace App\Http\Controllers;

use App\CreateMember;
use App\Forms\MemberCreateForm;
use App\Forms\MemberEditForm;
use App\Models\User;
use App\Tables\MembersTable;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $member;

    public function __construct(CreateMember $member)
    {
        $this->member = $member;
    }

    public function index()
    {
        $table = (new MembersTable(tenant()->id))->setup();

        return view('member.index')->with(compact('table'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(MemberCreateForm::class, [
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

        $this->member->create($data);

        return redirect(route('member.index'));
    }

    public function show($id)
    {

    }

    public function edit($id, FormBuilder $formBuilder)
    {
        $user = User::find($id);

        $form = $formBuilder->create(MemberEditForm::class, [
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
