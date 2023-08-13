<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //Change Password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //Change Password
    public function changePassword(Request $request){
        /*
        1. All field must be fill
        2. New Password & confirm Password length must be greater 6
        3. New Password & confirm password must same
        4. Client Old Password Must be save with db password
        5.Password Change
        */
        $this->passwordValidationCheck($request);
        // $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password;//Hash Value
        if(Hash::check($request->oldPassword,  $dbHashValue)){
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return back()->with(['ChangeSuccess'=>'Password is Ready Change']);
        }
        return back()->with(['notMatch'=>'This old Password not match. Try Again']);
        // $hashValue = Hash::make('Win');//hash
        // if(Hash::check('Win', $ $hashValue)){
        //     dd('password Same');
        // }else{
        //     dd('incorrect');
        // }
        // dd($user->toArray());
        // dd('Change Password');
    }

    // Direct Admin details Page
    public function details(){
        return view('admin.account.details');
    }

    //Direct Admin Edit page
    public function edit(){
        return view('admin.account.edit');
    }

    // update account
    public function update($id, Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for iamge
        if($request->hasFile('image')){
            $dbImage =User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if($dbImage !=null){
                Storage::delete('public/' . $dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        // old image/ check=>delate/ store

        User::where('id', $id)->update($data);
        return redirect()->route('admin#deails')->with(['updateSuccess'=>'Admin Account Update']);
    }

     //Admin List
     public function list(){
        $admin=User::when(request('key'),function($query){
            $query ->orWhere('name','like','%'.request('key').'%')
                    ->orWhere('email','like','%'.request('key').'%')
                    ->orWhere('gender','like','%'.request('key').'%')
                    ->orWhere('phone','like','%'.request('key').'%')
                    ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
     }

     //Admin Delete
     public function delete($id){
        User::where('id', $id)->delete();
        return back()->with(['adminDelete'=> 'Admin Delete Success']);
     }

     //Change Role
     public function changeRole($id){
        $account= User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
     }

     //Change
     public function change($id, Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
     }

     //Request User to change
     private function requestUserData($request){
        return [
            'role'=>$request->role
        ];
     }
    //Reqest User data
    private function getUserData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'updated_at'=>Carbon::now()
        ];
    }
    // Account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'phone'=>'required',
            'image'=>'mimes:png,jpg,jpeg,webp|file',
            'address'=>'required'
        ])->validate();
    }

    // password validation Check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ],[
            'oldPassword.required'=>'အဟောင္းနဲ့ဖျစ္ရမည္',
        ])->validate();
    }
}
