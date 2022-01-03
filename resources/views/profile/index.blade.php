@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="name">
                                    <h5>・名前</h5>
                                    {{ str_limit($post->name,20) }}
                                </div>
                                <div class="gender mt-3">
                                    <h5>・性別</h5>
                                    {{ str_limit($post->gender,10) }}
                                </div>
                                <div class="hobby　mt-3">
                                    <h5>・趣味</h5>
                                    {{ str_limit($post->hobby,200) }}
                                </div>
                                <div class="introduction mt-3">
                                    <h5>・自己紹介</h5>
                                    {{ str_limit($post->introduction,1500) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
@endsection