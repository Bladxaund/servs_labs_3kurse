@extends('layouts.app')
@section('title', 'Регистрация')
@section('content')
    <div class="page" style="max-width: 500px; margin: 40px auto; padding: 30px; box-sizing: border-box;">
        <h1 style="text-align: center; margin-top: 0; margin-bottom: 25px;">Регистрация</h1>
        
        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Имя:</label>
                <input type="text" name="name" value="{{ old('name') }}" required style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Пароль:</label>
                <input type="password" name="password" required style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Повторите пароль:</label>
                <input type="password" name="password_confirmation" required style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px;">
            </div>
            
            <button type="submit" style="width: 100%; background: #2d3748; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">Зарегистрироваться</button>
        </form>
    </div>
@endsection