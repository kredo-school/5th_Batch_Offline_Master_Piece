<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\StoreProfileRequest;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;

class ProfileController extends Controller
{
    //
    private $user;
    private $profile;

    public function __construct(User $user,Profile $profile)
    {
        $this->user = $user;
        $this->profile = $profile;
    }

    public function show($id)
    {
        $user = $this->user->findOrfail($id);

        return view('users.guests.profile.show')->with(compact('user'));
    }

    public function bookmark($id)
    {
        $user = $this->user->findOrfail($id);

        return view('users.guests.profile.bookmark')->with(compact('user'));
    }

    public function order($id)
    {
        $user = $this->user->findOrfail($id);

        return view('users.guests.profile.order')->with(compact('user'));
    }

    public function comment($user_id)
    {

                 // 指定されたユーザーを取得
                 $user = $this->user->findOrFail($user_id);
             
                 // コメントの基本クエリ
                 $commentsQuery = Comment::where('guest_id', $user->id);
             
                 // 最終的なコメントの結果を取得
                 $comments = $commentsQuery->orderBy('created_at', 'desc')->get();
             
                 // ビューにデータを渡す
                 return view('users.guests.profile.comment', compact('user', 'comments'));
    }

    public function edit()
    {
        $user = $this->user->findOrfail(Auth::user()->id);
        $prefectures = [
            'Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama',
            'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka',
            'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama',
            'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita',
            'Miyazaki', 'Kagoshima', 'Okinawa'
        ];

        return view('users.guests.profile.edit')->with(compact('user','prefectures'));
    }



    public function welcome()
    {
        $user = $this->user->findOrfail(Auth::user()->id);
        $prefectures = [
            'Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama',
            'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka',
            'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama',
            'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita',
            'Miyazaki', 'Kagoshima', 'Okinawa'
        ];

        return view('users.guests.profile.welcome')->with(compact('user','prefectures'));
    }

    public function store(StoreProfileRequest $request)
    {
        $validated = $request->validated();

        $this->profile->user_id =  $validated['user_id'];
        $this->profile->first_name =  $validated['first_name'];
        $this->profile->last_name = $validated['last_name'];
        $this->profile->gender = $validated['gender'];
        $this->profile->birthday = $validated['birthday'];
        $this->profile->phone_number = $validated['phone_number'];
        $this->profile->address = $validated['address'];
        if($validated['introduction']){
            $this->profile->introduction = $validated['introduction'];
        }

        if($validated['avatar']){
            $this->profile->avatar = 'data:image/'.$validated['avatar']->extension().';base64,'.base64_encode(file_get_contents($validated['avatar']));
        }

        # Save
        $this->profile->save();

        return redirect()->route('home');


    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        $validated = $request->validated();

        $user->profile->first_name =  $validated['first_name'];
        $user->profile->last_name = $validated['last_name'];
        $user->profile->gender = $validated['gender'];
        $user->profile->birthday = $validated['birthday'];
        $user->profile->phone_number = $validated['phone_number'];
        $user->profile->address = $validated['address'];
        if(isset($validated['introduction'])){
            $user->profile->introduction = $validated['introduction'];
        }

        if(isset($validated['avatar'])){
            $user->profile->avatar = 'data:image/'.$validated['avatar']->extension().';base64,'.base64_encode(file_get_contents($validated['avatar']));
        }

        # Save
        $user->profile->save();

        return redirect()->route('profile.show', Auth::user()->id);

    }

    public function searchlist()
    {
        return view('users.guests.profile.search-list');
    }

    public function inquiry()
    {
        return view('inquiry');
    }


}
