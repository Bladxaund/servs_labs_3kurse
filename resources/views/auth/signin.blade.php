@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    {{-- Ограничиваем ширину всей карточки до 450px --}}
    <div class="page" style="max-width: 450px; margin: 40px auto;">
        <h1 style="text-align: center; margin-bottom: 25px;">Регистрация</h1>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registration.post') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 8px; font-weight: bold; color: #2d3748;">Имя:</label>
                {{-- Добавили box-sizing: border-box, чтобы padding не увеличивал ширину --}}
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       style="width: 100%; box-sizing: border-box; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 16px; outline: none; transition: border-color 0.2s;" 
                       onfocus="this.style.borderColor='#2d3748'" onblur="this.style.borderColor='#cbd5e1'">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 8px; font-weight: bold; color: #2d3748;">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       style="width: 100%; box-sizing: border-box; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 16px; outline: none; transition: border-color 0.2s;" 
                       onfocus="this.style.borderColor='#2d3748'" onblur="this.style.borderColor='#cbd5e1'">
            </div>

            <div style="margin-bottom: 25px;">
                <label for="password" style="display: block; margin-bottom: 8px; font-weight: bold; color: #2d3748;">Пароль:</label>
                <input type="password" name="password" id="password" 
                       style="width: 100%; box-sizing: border-box; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 16px; outline: none; transition: border-color 0.2s;" 
                       onfocus="this.style.borderColor='#2d3748'" onblur="this.style.borderColor='#cbd5e1'">
            </div>

            <button type="submit" style="width: 100%; background: #2d3748; color: #fff; padding: 14px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; transition: background 0.2s;" onmouseover="this.style.background='#1a202c'" onmouseout="this.style.background='#2d3748'">
                Зарегистрироваться
            </button>
        </form>
    </div>
@endsection