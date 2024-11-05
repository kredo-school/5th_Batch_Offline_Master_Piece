<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\User; // クラスのインポート

class RegisterStoreMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
//     public function __construct($name)
//     {
//         $this->name = $name;
//     }

//     public function build()
// {
//     return $this->to('ponpokoman05@gmail.com')  // 送信先アドレス
//         ->subject('登録完了しました。')// 件名
//         ->view('admin.stores.register-mail')   // 本文
//         ->with(['name' => $this->name]);    // 本文に送る値
// }
public $name;
public $password;
public $email;

public function __construct($name, $password, $email)
{
    $this->name = $name;
    $this->password = $password; 
    $this->email = $email; 
}

public function build()
{
    return $this->to($this->email)  // 送信先アドレスを登録したメールアドレスに設定
        ->subject('password notification') // 件名
        ->view('emails.register_mail') // 本文
        ->with([
                'name' => $this->name,
                'password' =>$this->password
                ]); // 本文に送る値
}

}
   