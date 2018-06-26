@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">プロフィール</div>

                <div class="panel-body">
                    <table>
                        <tr>
                            <td>名前</td>
                            <td>{{$user['name']}}</td>
                        </tr>
                        <tr>
                            <td>メールアドレス</td>
                            <td>{{$user['email']}}</td>
                        </tr>
                        <tr>
                            <td>性別</td>
                            <td>{{$user['gender']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
