<?php

namespace Infogue\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Infogue\Contributor;
use Infogue\Http\Controllers\Controller;
use Infogue\Http\Requests;
use Infogue\Setting;
use Infogue\Uploader;
use Infogue\User;

class AccountController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Account Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling api for contributor
    | registration contributor login and update their data.
    |
    */

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $token = rand(0, 1000) . uniqid();

        $exist = Contributor::whereUsername($request->input('username'))
            ->orWhere('email', '=', $request->input('email'))->first();

        if (count($exist)) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'exist',
                'message' => 'Username or Email is already exist',
                'timestamp' => Carbon::now(),
            ], 400);
        } else {
            $contributor = Contributor::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'token' => $token,
                'vendor' => 'web',
            ]);

            $this->sendingActivationEmail($contributor);

            $this->sendAdminContributorNotification($contributor);

            return response()->json([
                'request_id' => uniqid(),
                'status' => 'success',
                'message' => 'Registering user is success',
                'timestamp' => Carbon::now(),
            ], 200);
        }
    }

    /**
     * Send registered user with email activation.
     *
     * @param $contributor
     * @return Collection
     */
    public function sendingActivationEmail($contributor)
    {
        $data = [
            'name' => $contributor->username,
            'token' => $contributor->token
        ];

        Mail::send('emails.welcome', $data, function ($message) use ($contributor) {
            $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

            $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

            $message->to($contributor->email)->subject('Welcome to Infogue.id');
        });

        return $contributor;
    }

    /**
     * Send notification email for admin or support.
     *
     * @param $contributor
     */
    public function sendAdminContributorNotification($contributor)
    {
        $notification = Setting::whereKey('Email Contributor')->first();

        if ($notification->value) {
            $admins = User::all(['name', 'email']);

            foreach ($admins as $admin) {
                if ($admin->email != 'anggadarkprince@gmail.com' && $admin->email != 'sketchprojectstudio@gmail.com') {
                    Mail::send('emails.admin.contributor', ['admin' => $admin, 'contributor' => $contributor], function ($message) use ($admin, $contributor) {
                        $message->from(env('MAIL_ADDRESS', 'no-reply@infogue.id'), env('MAIL_NAME', 'Infogue.id'));

                        $message->replyTo('no-reply@infogue.id', env('MAIL_NAME', 'Infogue.id'));

                        $message->to($admin->email)->subject($contributor->name . ' joins Infogue.id');
                    });
                }
            }
        }
    }

    /**
     * Store a newly created account in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $user = Contributor::where('email', $request->input('username'))
            ->orWhere('username', $request->input('username'))->first();

        $respond = [
            'request_id' => uniqid(),
            'timestamp' => Carbon::now(),
        ];

        if (count($user)) {
            $respond['status'] = $user->status;

            if ($user->status != 'activated') {
                $respond['login'] = 'restrict';
                $respond['message'] = 'The account is pending or suspended';
                $code = 403;
            } else {
                $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

                $request->merge([$field => $request->input('username')]);

                $credentials = $request->only($field, 'password');

                if (Auth::attempt($credentials)) {
                    $respond['login'] = 'granted';
                    $respond['message'] = 'Credentials are valid';
                    $code = 200;
                } else {
                    $respond['login'] = 'mismatch';
                    $respond['message'] = 'Username or password is incorrect';
                    $code = 401;
                }
            }
        } else {
            $respond['status'] = 'unregistered';
            $respond['login'] = 'restrict';
            $respond['message'] = 'These credentials do not match our records';
            $code = 403;
        }

        return response()->json($respond, $code);
    }

    /**
     * Update the specified contributor in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $contributor = Contributor::findOrFail($request->input('contributor_id'));

        $credential = Hash::check($request->input('password'), $contributor->password);

        if (!$credential) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'mismatch',
                'message' => 'Current password is mismatch',
                'timestamp' => Carbon::now(),
            ], 401);
        }

        $contributor->name = $request->input('name');
        $contributor->gender = $request->input('gender');
        $contributor->birthday = $request->input('birthday');
        $contributor->location = $request->input('location');
        $contributor->contact = $request->input('contact');
        $contributor->about = $request->input('about');
        $contributor->username = $request->input('username');
        $contributor->email = $request->input('email');
        $image = new Uploader();
        if ($image->upload($request, 'avatar', base_path('public/images/contributors/'), 'avatar_' . $request->input('contributor_id'))) {
            $contributor->avatar = $request->input('avatar');
        }
        if ($image->upload($request, 'cover', base_path('public/images/covers/'), 'cover_' . $request->input('contributor_id'))) {
            $contributor->cover = $request->input('cover');
        }
        $contributor->instagram = $request->input('instagram');
        $contributor->facebook = $request->input('facebook');
        $contributor->twitter = $request->input('twitter');
        $contributor->googleplus = $request->input('googleplus');
        $contributor->email_subscription = $request->input('email_subscription');
        $contributor->email_message = $request->input('email_message');
        $contributor->email_follow = $request->input('email_follow');
        $contributor->email_feed = $request->input('email_feed');
        $contributor->mobile_notification = $request->input('mobile_notification');
        if ($request->has('new_password') && !empty($request->get('new_password'))) {
            $request->merge(['password' => Hash::make($request->input('new_password'))]);
            $contributor->password = $request->input('password');
        }

        if ($contributor->save()) {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'success',
                'message' => 'Setting was updated',
                'timestamp' => Carbon::now(),
            ]);
        } else {
            return response()->json([
                'request_id' => uniqid(),
                'status' => 'failure',
                'message' => Lang::get('alert.database.generic'),
                'timestamp' => Carbon::now(),
            ], 500);
        }
    }
}
