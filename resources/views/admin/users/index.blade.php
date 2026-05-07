@extends('layout.admin.theme')
@section('content')
    <div class="container">
        <h1>Пользователи</h1>
          <div class="search">
            <form action="{{ route('admin.users.search') }}" method="get" class="search_form">
                <div class="input_div">
            <input type="text" name="q" placeholder="Имя или ID" @if(isset($q))value="{{ $q }}"@endif>
             </div>
               <input type="submit" value="Найти">
        </form>
    </div>
       
            @foreach ($users as $user)
                <div class="item">
                    <div class="id">ID: {{ $user->id }}</div>
                    <div class="name">Имя профиля: {{ $user->name }}</div>
                    <div class="role">Роль: {{ $user->userRole->name }}</div>
                </div>
            @endforeach
      
    </div>

@endsection