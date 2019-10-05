<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/otp';
    protected $redirectTo;
    
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //,'iscustomer'=>0
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        
        if (Auth::once(['email' => $credentials['email'], 'password' => $credentials['password'], 'status' => 1]) ) {
            //dd('admin');
            $user = app('auth')->getProvider()->retrieveByCredentials($request->only('email', 'password'));
            
            //Put Required values in session
            $request->session()->put("user_id", $user->id);
            $request->session()->put("fname", $user->fname);
            $request->session()->put("lname", $user->lname);
            $request->session()->put("remember", $request->get('remember'));

            //Updating user table with new otp            
            $randcode=rand(100000,999999);
            $userotp=\App\User::find($user->id);         
            $userotp->otp=$randcode;
            $userotp->save();
            /* Temp code, Need to apply SMS service here and 
            then. After that need to remove that session variable
            */
            if(!empty($user->phonenumber)){
            //Sending SMS to Application/lead begins
            $smstemplate="";
            $ufoneid="";
            $ufonemasking="";
            $ufonepassword="";
            $ufoneapiurl="";
            //Get SMS API preferences begins
            $preferences= \App\Preference::whereIn('option',['ufoneid', 'ufonemasking', 'ufonepassword','ufoneapiurl'])->get();
            foreach($preferences as $preference){
                
                if($preference->option=='ufoneid'){
                    $ufoneid=$preference->value;
                }
                if($preference->option=='ufonemasking'){
                    $ufonemasking=$preference->value;
                }
                if($preference->option=='ufonepassword'){
                    $ufonepassword=$preference->value;
                }
                if($preference->option=='ufoneapiurl'){
                    $ufoneapiurl=$preference->value;
                }
                
            }
            //Get SMS API preferences ends
            $message = "Your ERP OTP is: ".$randcode;
            
            $api_call  = "";
            $api_call .= "?id=".$ufoneid;
            $api_call .= "&message=".urlencode(trim($message));
            $api_call .= "&shortcode=".$ufonemasking;
            $api_call .= "&lang=english";
            $api_call .= "&password=".$ufonepassword;
            if (substr($user->phonenumber, 0, 1) == '0' || substr($user->phonenumber, 0, 2) == '00') {
                $mobilenumber=ltrim($user->phonenumber,0);
            }else{
                $mobilenumber=$user->phonenumber;
            }
            $api_call .= "&mobilenum=92".$mobilenumber;               
            $ch = curl_init($ufoneapiurl.$api_call);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);

            
            // from documentation
            // 0 = Text message successfully sent
            // 1 = Text message could not sent successfully
            $xml = new \SimpleXMLElement($response);
            if ($xml->response_id=="0") {
                $sendsms=true; 
            } else {
                $sendsms=false;
            }               
            //Sending SMS to Application/lead ends
            }
            $request->session()->put('otp', $randcode);
            //Redirect to 2FA/OTP
            return redirect('otp');
        }
        //else{

           // $user = Auth::user()->id;

        //}
        /*elseif(Auth::once(['email' => $credentials['email'], 'password' => $credentials['password'], 'status' => 1,'iscustomer'=>1])) 
        {
            //$user = Auth::user();
            //dd($user); 
           // return view('customer-front.dashboard');
            return redirect()->route('customer/dashboard');
            //echo "string";exit();
        }
       */
        //redirect again to login view with some errors
        return redirect()->guest('/login')
                    ->withInput($request->only('email', 'remember'))
                    ->with('error', $this->getFailedLoginMessage());
          
    }

    /*public function redirectTo(){
        
    // User role
    //$role = Auth::user()->role->id; 
    //r5dd($role);


    if(\Auth::user()->role->id==3)
        {

            echo "customer";exit();
            $this->redirectTo = 'customer/dashboard';
            return $this->redirectTo;
            
        } 
    else 
        {
          dd(\Auth::user()->role->id);
        $this->redirectTo = '/otp';
        return $this->redirectTo;
         
        
            //return redirect()->intended('/User/posts');
        }
    }    
   */

   /* public function authenticated(Request $request, $user)
    {
        dd($user);
      if($request->get("app")==false)
         return redirect("url");

      if($request->get("app")==true)
         return redirect("another-url");

      return redirect("dashboard");
    }
*/
    protected function getFailedLoginMessage()
    {
        return 'Invalid Login Information Plese try again.';
    }
    
}
