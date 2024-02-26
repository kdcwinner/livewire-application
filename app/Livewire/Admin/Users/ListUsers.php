<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;


class ListUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $state = [];
    public $editUserModal = false;
    public $user;
    public $userBeingDeleted = null;

    public function addNewUser(){
        $this->editUserModal = false;
        $this->dispatch('add-new-user-modal');
    }
    public function createUser(){
        $validatedData = Validator::make($this->state,
        [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=> 'required|alpha_num|between:8,12|confirmed',
            'password_confirmation' => 'required|alpha_num|between:8,12',
        ],['unique'=> 'The :attribute already been used.','confirmed'=> 'Password and Confirm Password field does not match.',])->validate();

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
      //  session()->flash('message','User created successfully!');
        $this->state = [];
        $this->dispatch('add-new-user-modal-hide',['message'=>'User created successfully!']);        
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit(User $user){
        $this->editUserModal = true;
        $this->user = $user;        
        $this->state = $user->toArray();
        $this->dispatch('edit-user-modal');    
    }

    public function updateUser(){

        $validatedData = Validator::make($this->state,
        [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$this->user->id,
            'password'=> 'sometimes|between:8,12|confirmed',
           
        ],['unique'=> 'The :attribute already been used.',])->validate();

        if(!empty($validatedData['password'])){
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        $this->user->update($validatedData);
        $this->state = [];
        $this->dispatch('add-new-user-modal-hide',['message'=>'User updated successfully!']);  

    }

    public function userDeleteConfirmation($userId){
        //dd($userId);
        $this->userBeingDeleted = $userId;
        $this->dispatch('show-delete-confirmation');
        //User::find($userId)->delete();
    }

    public function deleteUser(){
       
        $userDelete =  User::findOrFail($this->userBeingDeleted);
        $userDelete->delete();
        $this->dispatch('hide-delete-confirmation',['message'=>'User deleted successfully!']);
    }

    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')->orWhere('email','like', '%'.$this->search.'%')->paginate(5);
        return view('livewire.admin.users.list-users',['users'=>$users]);
    }
}
