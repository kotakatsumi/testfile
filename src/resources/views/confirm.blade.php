@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/confirm.css')}}">
@endsection

@section('content')
    <h1 class="page-title">Confirm</h1>
    <div class="confirm-table">
        <form action="/thanks" method="post">
            @csrf
            <table class="confirm-table">
                <tr class="table-line">
                    <th class="column-title">お名前</th>
                    <td class="table-cell">
                        <input class="read-input" name="fullname" type="text" value="{{$fullname}}" readonly>
                    </td>
                </tr>
                <tr class="table-line">
                    <th class="column-title">性別</th>
                    <td class="table-cell">
                        <input class="read-input" name="gender" value="{{$contact['gender']}}" readonly>
                    </td>
                </tr>
                <tr class="table-line">
                    <th class="column-title">メールアドレス</th>
                    <td class="table-cell">
                        <input class="read-input" name="email" type="email" value="{{$contact['email']}}" readonly>
                    </td>
                </tr>
                <tr class="table-line">
                    <th class="column-title">電話番号</th>
                    <td class="table-cell">
                        <input class="read-input" name="tell" type="tel" value="{{$tell}}" readonly>
                    </td>
                </tr>
                <tr class="table-line">
                    <th class="column-title">住所</th>
                    <td class="table-cell">
                        <input class="read-input" name="address" type="text" value="{{$contact['address']}}" readonly>
                    </td>
                </tr>
                <tr class="table-line">
                    <th class="column-title">建物名</th>
                    <td class="table-cell">
                        <input class="read-input" name="building" type="text" value="{{$contact['building']}}" readonly>
                    </td>
                </tr>
                <tr class="table-line">
                    <th class="column-title">お問い合わせの種類</th>
                    <td class="table-cell">
                        <input class="read-input" name="category_id" type="text" value="{{$contact['category_id']}}" readonly>
                    </td>
                </tr>
                <tr class="table-line">
                    <th class="column-title">お問い合わせ内容</th>
                    <td class="table-cell">
                        <textarea class="read-input" name="detail" readonly>{{$contact['detail']}}</textarea>
                    </td>
                </tr>
            </table>
            <div class="flex">
            <div class="buttons-area">
                <button class="toThanks" type="submit">送信</button>
            </div>
        </form>
        <form action="/confirm/fix" method="get">
            @csrf
            <div class="fix-area">
                <button class="toFix" type="submit">修正</button>
            </div>
            </div>
        </form>
    </div>
@endsection