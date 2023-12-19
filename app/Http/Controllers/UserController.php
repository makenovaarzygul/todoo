<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function authPage(){
    	return view('User.Auth');
    }

    public function registerPage(){
    	return view('User.Register');
    }
public function authAction(Request $request){
        // Здесь вы можете добавить логику для аутентификации пользователя
        // Получение данных из $request
        // Валидация данных
        // Попытка аутентификации пользователя
        
        // Пример:
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Если аутентификация прошла успешно
            return redirect()->intended('/todo'); // Перенаправление на страницу после успешной аутентификации
        } else {
            // Если аутентификация не удалась
            return back()->withErrors(['email' => 'Неверный email или пароль']); // Перенаправление с ошибкой
        }
    }

    public function registerAction(Request $request){
        // Здесь вы можете добавить логику для регистрации пользователя
        // Получение данных из $request
        // Валидация данных
        // Создание нового пользователя
        
        // Пример:
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // После успешной регистрации можно выполнить дополнительные действия, например, автоматическая аутентификация
        auth()->login($user);

        return redirect('/todo'); // Перенаправление на страницу после успешной регистрации
    }

    public function logout(){
    	auth()->logout();
    	 return redirect('/'); 
    }
}
