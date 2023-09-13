@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{route('addpassword')}}">
                            @csrf
                            <h2>Dodaj nowe hasło do pamietnika</h2>
                            <div class="form-group">
                            <label>URL</label>
                            <input type="text" name="url" class="form-control" id="url" placeholder="Wprowadz URL">
                            </div>
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" name="login" class="form-control" id="login" placeholder="Wprowadz login">
                                </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Wprowadz hasło">
                            </div>
                            <x-button class="mt-5 mb-5 hover:bg-green-700">
                                Dodaj nowe hasło
                            </x-button> 
                          </form>
                          <h2>Tabela z hasłami</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Login</th>
                                <th scope="col">Password</th>
                                <th scope="col">URL</th>
                                <th scope="col">Wygasanie</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($diary as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->login }}</td>
                                <td>********</td>
                                <td>{{ $item->url }}</td>
                                <td>
                                    <?php
                                    if(strtotime($item->created_at) <  strtotime('-14 days'))
                                    {//wygasniete
                                        echo "<div class='font-weight-bold text-danger'>Hasło jest starsze niz 14 dni.</div>";
                                    } else echo "<div class='font-weight-bold text-success'>Hasło jest aktualne.</div>"; //niewygasniete
                                    ?>
                                </td>
                            </tr>                       
                            @endforeach      
                            </tbody>
                        </table>

                        @if($diary->count() > 0)
                        <form method="POST" action="{{route('showpassword')}}">
                          @csrf
                          <h2>Odkryj hasła, podając hasło do aktualnie zalogowanego konta.</h2>
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Wprowadz hasło">
                        </div>
                          <x-button class="mt-2 mb-5 hover:bg-green-700">
                            Pokaz hasła
                        </x-button> 
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
