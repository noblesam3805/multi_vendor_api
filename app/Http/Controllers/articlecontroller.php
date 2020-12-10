<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\product;
use App\Http\Resources\artic as articresource;
use Auth;
use App\User;
use App\order;
use Session;

class articlecontroller extends Controller
{

    public function __construct(){
        auth()->setDefaultDriver('api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $article = DB::table('articles')->where('user_id', 1);
        $products = product::orderBy('created_at', 'desc')->paginate();
        return $products;
        // return articresource::collection($article);
    }
    public function getorders($id)
    {
        // $article = DB::table('articles')->where('user_id', 1);
        $orders = order::orderBy('created_at', 'desc')->where('user_id', $id)->paginate();
        return $orders;
        // return articresource::collection($article);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $request->isMethod('PUT') ? product::find($request->id) : new product;

        $product->user_id = $request->input('user_id');
        $product->name = $request->input('name');
        $product->category = $request->input('category');
        $product->c_model = $request->input('c_model');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        // $imagename = $request->image1->getClientOriginalName();
        // $product->image1 = request('image1')->storeAs('public',$imagename);
        $product->image1 = request('image1');
        $product->image2 = request('image2');
        $product->image3 = request('image3');
        $product->image4 = request('image4');
        $product->image5 = request('image5');

        $product->save();
        return 'posted successfully';
        //  return new articresource($article);

    }
    public function order(Request $request)
    {
        $order = $request->isMethod('PUT') ? order::find($request->id) : new order;

        $order->user_id = $request->input('user_id');
        $order->user_name = $request->input('user_name');
        $order->user_phone = $request->input('user_phone');
        $order->p_name = $request->input('p_name');
        $order->p_qty = $request->input('p_qty');
        $order->p_model = $request->input('p_model');
        $order->p_price = $request->input('p_price');
        $order->p_desc = $request->input('p_desc');
        // $imagename = $request->image1->getClientOriginalName();
        // $product->image1 = request('image1')->storeAs('public',$imagename);

        $order->save();
        return 'Ordered successfully';
        //  return new articresource($article);

    }

    public function completed($id)
    {
        $order = order::find($id);
        $order->status = 'Completed';
        $order->save();
         return 'Order marked as completed';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return new articresource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   // public function edit($id)
   // {
        //
   // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  //  public function update(Request $request, $id)
   // {
        //
   // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = order::find($id);
        if($order->delete()){
        return "Order removed successfully";
        }
    }

    public function login(Request $request){
        // $this->validate($request,[
        //     'password'=>'required',
        //     'name'=>'required',
        // ]);
    //    if(!$creds=Auth::attempt (['name'=> $request->input('name'),
    //     'password'=>$request->input('password')])){
    //         return 'incorrect name or password';
    //     }
    //     else{
    //     //   $token = response()->json(['token' => $creds]);
    //      return true;

    //     }
    $name = $request->input('name');
    $password = $request->input('password');
    $con = mysqli_connect("localhost", "root", "", "m_vendor_api");
    $sql = "select * from users where name = '$name' AND password = '$password' AND active = '1'";
    $res = mysqli_query($con,$sql);
    $rows = mysqli_fetch_array($res);
    if($rows){
        return $arr = array("success"=> "logged in successful", "name"=>$name, "password"=>$password,
         "user_type"=>$rows['user_type'], "id"=>$rows['id'], "phone"=>$rows['phone'],
         "email"=>$rows['email']);
    }
    else{
        return $arr = array("error"=> "user not found, if registered please check email(spam or
        inbox for account activation link)");
    }


    }
    public function reg(Request $request){
        if(User::where('name', '=', $request->input('name'))->count() > 0){
            return $arr = array("error"=> "name already exists");
        }

       else{
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->phone = $request->input('phone');
            $user->save();
            return $arr = array("success"=> "success");

       }

    }

    public function u_user(Request $request, $id){

            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->phone = $request->input('phone');
            $user->save();
            return $arr = array("ok"=> "Account Details Updated Successfuly");

    }

    public function mail(Request $request){
        // $user = User::where('name', '=', $request->input('name'));
        $con = mysqli_connect("localhost", "root", "", "m_vendor_api");
        $name = $request->input('name');
        $sql = "select * from users where name = '$name'";
        $res = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($res);
        $id = $row['id'];
        $headers = 'From: admin@sell.com' . "\r\n" .
        'Reply-To: admin@sell.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
             if(mail($request->input('email'), 'Account Activation',
              `http://127.0.0.1:8000/api/activate/$id`,$headers)){
                return $arr = array("mail"=> "mail success",'id'=>$id);
             }

    }
    public function activate(Request $request)
    {
        $user = User::find($request->id);
        $user->active = 1;
        // $article->completed = $article->completed  ? 0 : 1;

        $user->save();
         return array('activated'=>'Account activated');

    }

}
