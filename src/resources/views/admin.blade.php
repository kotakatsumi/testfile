@extends('layouts.auth')


@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/admin.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
@endsection

@section('header')
    @if(Auth::check())
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="logout">Logout</button>
        </form>
    @endif
@endsection

@section('content')
<h1 class="page-title">Admin</h1>
<div class="container">
    <form action="/admin/search" method="get">
    @csrf
        <div class="search-form">
            <div class="name-email">
                <input name="name_email_search" type="text" class="name_email_search" placeholder="名前やメールアドレスを入力してください">
                <input type="submit" value="🔍" class="search-button">
            </div>
            <div class="gender">
                <select name="gender_search" class="gender_search">
                    <option disabled>性別</option>
                    <option value="0">全て</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
            </div>
            <div class="category_id">
                <select name="category_search" class="category_search">
                    <option disabled selected>選択してください</option>
                    <option value="1">商品のお届けについて</option>
                    <option value="2">商品の交換について</option>
                    <option value="3">商品トラブル</option>
                    <option value="4">ショップへのお問い合わせ</option>
                    <option value="5">その他</option>
                </select>
            </div>
            <div class="date">
                <input type="date" name="date_search" class="date_search">
            </div>
        </div>
    </form>
    <div class="contacts-table">
        <div class="above-table">
            <form action="/admin/export" method="get">
                @csrf
                <button type="submit" class="export">エクスポート</button>
            </form>
            <div class="pagination-link">
                {{$contacts->appends(request()->query())->links()}}
            </div>
        </div>
        <table  class="contacts-database" cellspacing="0">
            <tr>
                <th class="column-title">お名前</th>
                <th class="column-title">性別</th>
                <th class="column-title">メールアドレス</th>
                <th class="column-title">お問い合わせの種類</th>
                <th class="column-title"></th>
            </tr>
            @foreach($contacts as $contact)
                <tr>
                    <td class="fullname_get{{$contact['id']}} fullname_get">{{$contact['fullname']}}</td>
                    <td class="gender_get{{$contact['id']}} gender_get">{{$contact['gender']}}</td>
                    <td class="email_get{{$contact['id']}} email_get">{{$contact['email']}}</td>
                    <td class="category_get{{$contact['id']}} category_get">{{$contact->category->getCategory()}}</td>
                    <td class="detail_get">
                        <div class="show-detail" id="{{$contact['id']}}">
                            詳細
                        </div>
                    </td>
                    <div class="hidden-area">
                        <p class="tell_get{{$contact['id']}}">{{$contact['tell']}}</p>
                        <p class="address_get{{$contact['id']}}">{{$contact['address']}}</p>
                        <p class="building_get{{$contact['id']}}">{{$contact['building']}}</p>
                        <p class="detail_get{{$contact['id']}}">{{$contact['detail']}}</p>
                    </div>
                </tr>
            @endforeach
        </table>
        <div class="modal">
            <div class="close-button">
                ×
            </div>
        <table class="modal-table">
            <tr>
                <th class="line-title">お名前</th>
                <td class="fullname-modal modal-cell"></td>
            </tr>
            <tr>
                <th class="line-title">性別</th>
                <td class="gender-modal modal-cell"></td>
            </tr>
            <tr>
                <th class="line-title">メールアドレス</th>
                <td class="email-modal modal-cell"></td>
            </tr>
            <tr>
                <th class="line-title">電話番号</th>
                <td class="tell-modal modal-cell"></td>
            </tr>
            <tr>
                <th class="line-title">住所</th>
                <td class="address-modal modal-cell"></td>
            </tr>
            <tr>
                <th class="line-title">建物名</th>
                <td class="building-modal modal-cell"></td>
            </tr>
            <tr>
                <th class="line-title">お問い合わせの種類</th>
                <td class="category-modal modal-cell"></td>
            </tr>
            <tr>
                <th class="line-title detail-title">お問い合わせ内容</th>
                <td class="detail-modal modal-cell"><textarea class="detail-text-modal"></textarea></td>
            </tr>
        </table>
        <div class="delete-area">
            <form action="/admin/delete" method="post">
                @csrf
                <input name="id" type="hidden" value="" class="delete-id">
                <button class="delete-button" type="submit">削除</button>
            </form>
        </div>
        </div>
        <div class="reset">
            <a href="/admin" class="reset-link">リセット</a>
        </div>
    </div>
</div>
@endsection