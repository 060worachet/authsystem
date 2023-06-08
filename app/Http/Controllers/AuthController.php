<?php
 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ForgotPasswordMail;
use Laravel\Socialite\Facades\Socialite;
use Mail;
use Str;
use Illuminate\Auth\Events\Registered;
class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
 
    

public function registerPost(Request $request)
{
    // ตรวจสอบว่ามี email หรือ password ที่ซ้ำกับข้อมูลที่มีอยู่แล้วหรือไม่
    $existingUser = User::where('email', $request->email)->orWhere('password', Hash::make($request->password))->first();

    if ($existingUser) {
        // หากพบ email ให้ส่งข้อความแจ้งเตือนว่าซ้ำ
        return back()->with('notsuccess', 'อีเมลล์นี้ถูกลงทะเบียนไปแล้ว');

    }

    // หากไม่พบ email ซ้ำ ดำเนินการสร้างผู้ใช้ใหม่
    $user = new User();

    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);

    $user->save();

    // สร้างเหตุการณ์ Registered และส่งออก
    event(new Registered($user));

    return Redirect::to('/login')->with('success', 'ลงทะเบียนสำเร็จ โปรดเช็คอีเมลล์เพื่อยัน');
}

public function resendconfirm_email(Request $request)
{
    // รับข้อมูลผู้ใช้งานที่ล็อคอินแล้ว
    $user = Auth::user();

    // สร้างเหตุการณ์ Registered และส่งออก
    event(new Registered($user));

    // เพิ่มเงื่อนไขเพื่อตรวจสอบการส่งอีเมลสำเร็จ
    if (event(new Registered($user))) {
        return back()->with('verify-success', 'Please check your email');
    } else {
        // กรณีที่ไม่สามารถส่งอีเมลได้
        return back()->with('verify-error', 'Failed to send confirmation email');
    }
}


    
 
    public function login()
    {
        return view('login');
    }
 
    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credetials)) {
            return redirect('/')->with('success', 'Login Success');
        }
 
        return back()->with('error', 'Error Email or Password');
    }
 
    public function logout()
    {
        Auth::logout();
 
        return redirect()->route('login');
    }
    public function forgotpassword()
    {
    return view('auth.forgot');
    # code...
    }

    public function postforgotpassword(Request $request)
    {
    /* dd($request->all()); */
    $user = User::getEmailSingle($request->email);
    if(!empty($user))
    {
        $user->remember_token = Str::random(30);
        $user->save();
        Mail::to($user->email)->send(new ForgotPasswordMail($user));

        return redirect()->back()->with('success',"Please check you email and reset your password");
    }
    else
    {
        return redirect()->back()->with('error',"Email not found in the system.");
    }

    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset',$data);
        }
        else
        {
            abort(404);
        }

    }

    public function Postreset($token,Request $request)
    {
        # code...
        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url('login'))->with('success',"password successfully reset");
        }
        else
        {
        return redirect()->back()->with('error',"Password and comfirm password does not match.");
        }
    }

    public function loginwithgoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try{
            $user = Socialite::driver('google')->user();

            $is_user = User::where('email',$user->getEmail())->first();

            if(!$is_user){
                $saveUser = User::updateOrCreate(
                    [
                        'google_id' => $user->getId()
                    ],
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => Hash::make($user->email.'@'.$user->getId()),
                    ]
                    );
            }
            else{
                $saveUser = User::where('email',$user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email',$user->getEmail())->first();
            }

            Auth::loginUsingId($saveUser->id);

            /* return redirect()->route('/'); */
            return redirect()->to('/');
            
        }catch(\Throwable $th){
            throw $th;
        }
    }
}
