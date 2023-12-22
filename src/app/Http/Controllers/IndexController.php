<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function index(){
        return view('index');
    }

    public function confirm(ContactRequest $request){

        $familyName=implode(",",$request->only(['family-name']));
        $firstName=implode(",",$request->only(['first-name']));
        $fullName=$familyName."　".$firstName;

        $firstTel=implode(",",$request->only(['first-three']));
        $secondTel=implode(",",$request->only(['second-three']));
        $thirdTel=implode(",",$request->only(['third-three']));
        $tell=$firstTel.$secondTel.$thirdTel;

        $gender=$request->gender;
        $email=$request->email;
        $address=$request->address;
        $building=$request->building;
        $category=$request->category_id;
        $detail=$request->detail;

        $request->session()->put([
            'familyName'=>$familyName,
            'firstName'=>$firstName,
            'gender'=>$gender,
            'email'=>$email,
            'firstTel'=>$firstTel,
            'secondTel'=>$secondTel,
            'thirdTel'=>$thirdTel,
            'address'=>$address,
            'building'=>$building,
            'category_id'=>$category,
            'detail'=>$detail
        ]);

        $contact=$request->only(['gender','email','first-three','second-three','third-three','address','building','category_id','detail']);


        return view('confirm',['contact'=>$contact,'fullname'=>$fullName,'tell'=>$tell]);
    }

    public function fix(Request $request){
        $request->session()->flash('_old_input',[
            'familyName' => $request->session()->get('familyName'),
            'firstName' => $request->session()->get('firstName'),
            'gender' => $request->session()->get('gender'),
            'email' => $request->session()->get('email'),
            'firstTel' => $request->session()->get('firstTel'),
            'secondTel' => $request->session()->get('secondTel'),
            'thirdTel' => $request->session()->get('thirdTel'),
            'address' =>$request->session()->get('address'),
            'building' => $request->session()->get('building'),
            'category_id' => $request->session()->get('category_id'),
            'detail' => $request->session()->get('detail'),
        ]);
        return redirect('/');
    }

    public function store(Request $request){

        $genderName=implode(",",$request->only(['gender']));
        if($genderName=="男性"){
            $gender=1;
        }elseif($genderName=="女性"){
            $gender=2;
        }elseif($genderName=="その他"){
            $gender=3;
        }

        $categoryContent=implode(",",$request->only(['category_id']));
        if($categoryContent=="商品のお届けについて"){
            $category_id=1;
        }elseif($categoryContent=="商品の交換について"){
            $category_id=2;
        }elseif($categoryContent=="商品トラブル"){
            $category_id=3;
        }elseif($categoryContent=="ショップへのお問い合わせ"){
            $category_id=4;
        }elseif($categoryContent=="その他"){
            $category_id=5;
        }

        $request->session()->flush();

        $form=$request->all();
        $form["gender"]=$gender;
        $form["category_id"]=$category_id;
        Contact::create($form);
        return view('thanks');
    }

    public function admin(){
        $contacts=Contact::Paginate(10);

        for($i=0;$i<count($contacts);$i++){
            $contact_gender=$contacts[$i]["gender"];
            if($contact_gender==1){
                $contacts[$i]["gender"]="男性";
            }elseif($contact_gender==2){
                $contacts[$i]["gender"]="女性";
            }elseif($contact_gender==3){
                $contacts[$i]["gender"]="その他";
            }
        }

        return view('admin',compact('contacts'));
    }

    public function search(Request $request){
        $name_email_search=$request->name_email_search;
        $gender_search=$request->gender_search;
        $category_search=$request->category_search;
        $date_search=$request->date_search;

        $query=Contact::query();

        if(!empty($name_email_search)){
            $query->where('fullname','like','%'.$name_email_search.'%')->orWhere('email','like','%'.$name_email_search.'%');
        }
        if(!empty($gender_search)){
            $query->where('gender',$gender_search);
        }
        if(!empty($category_search)){
            $query->where('category_id',$category_search);
        }
        if(!empty($date_search)){
            $query->where('created_at','%'.$date_search.'%');
        }
        $contacts=$query->Paginate(10);

        for($i=0;$i<count($contacts);$i++){
            $contact_gender=$contacts[$i]["gender"];
            $contact_category=$contacts[$i]["category_id"];
            if($contact_gender==1){
                $contacts[$i]["gender"]="男性";
            }elseif($contact_gender==2){
                $contacts[$i]["gender"]="女性";
            }elseif($contact_gender==3){
                $contacts[$i]["gender"]="その他";
            }
        }

        return view('admin',compact('contacts'));
    }

    public function delete(Request $request){
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
