@extends('layouts.app')

@section('nav')
    <div class="row gx-2">
        <div class="col">
            <a type="button" class="btn btn-outline-secondary" href="{{ route('login')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                </svg>
                Вход
            </a>
        </div>
        <div class="col">
            <a type="button" class="btn btn-outline-secondary" href="{{ route('registration')}}" style="width: 150px">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                </svg>
                Регистрация
            </a>
        </div>
    </div>
@endsection

@section('form')
    <div class="card">
        <div class="card-header">
            Страница регистрации
        </div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="input" class="form-control" id="floatingInput" name="name" placeholder="Имя" value="{{ session('initials.name') }}">
                    <label for="floatingInput">Имя</label>
                    @if ($errors->has('name'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 20px; font-size: 15px">
                            <svg class="bi flex-shrink-0 me-2" width="15" height="15" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            @error('name') {{ $message }} @enderror
                        </div>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input type="input" class="form-control" id="floatingInput" name="surname" placeholder="Фамилия" value="{{ session('initials.surname') }}">
                    <label for="floatingInput">Фамилия</label>
                    @if ($errors->has('surname'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 20px; font-size: 15px">
                            <svg class="bi flex-shrink-0 me-2" width="15" height="15" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            @error('surname') {{ $message }} @enderror
                        </div>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input type="input" class="form-control" id="floatingInput" name="patronymic" placeholder="Отчество" value="{{ session('initials.patronymic') }}">
                    <label for="floatingInput">Отчество</label>
                    @if ($errors->has('patronymic'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 20px; font-size: 15px">
                            <svg class="bi flex-shrink-0 me-2" width="15" height="15" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            @error('patronymic') {{ $message }} @enderror
                        </div>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input type="login" class="form-control" id="floatingInput" name="login" placeholder="Логин" value="{{ session('initials.login') }}">
                    <label for="floatingInput">Логин</label>
                    @if ($errors->has('login'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 20px; font-size: 15px">
                            <svg class="bi flex-shrink-0 me-2" width="15" height="15" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            @error('login') {{ $message }} @enderror
                        </div>
                    @endif
                    <div id="passwordHelpBlock" class="form-text">
                        Логин должен состоять из латинских букв нижнего регистра и цифр и начинаться с буквы. Допускаются нижнее подчёркивание, дефиc и точка.
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Пароль" aria-describedby="passwordHelpBlock">
                    <label for="floatingPassword">Пароль</label>
                    @if ($errors->has('password'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 20px; font-size: 15px">
                            <svg class="bi flex-shrink-0 me-2" width="15" height="15" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            @error('password') {{ $message }} @enderror
                        </div>
                    @endif
                    <div id="passwordHelpBlock" class="form-text">
                        Пароль должен состоять не менее, чем из 8 символов, состоять из латинских букв верхнего и нижнего регистров, цифр, и не должен содержать пробелов.
                    </div>
                </div><div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" name="password_confirmation" placeholder="Подтвердите пароль">
                    <label for="floatingPassword">Подтвердите пароль</label>
                    @if ($errors->has('password_confirmation'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 20px; font-size: 15px">
                            <svg class="bi flex-shrink-0 me-2" width="15" height="15" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            @error('password_confirmation') {{ $message }} @enderror
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
