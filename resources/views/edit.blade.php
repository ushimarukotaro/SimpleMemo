@extends('layouts.app')

@section('javascript')
<script src="/js/confirm.js"></script>

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            メモ編集
            <form id="delete-form" class="mb-0" action="{{ route('destroy') }}" method="POST">
                @csrf
                <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id'] }}">
                <i class="fas fa-trash mr-3" onclick="deleteHandle(event);"></i>
            </form>
        </div>
        <form class="card-body my-card-body" action="{{ route('update') }}" method="POST">
            @csrf
            <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id'] }}">
            <div class="form-group">
                <textarea class="form-control" name="content" rows="3"
                    placeholder="ここにメモを入力">{{ $edit_memo[0]['content'] }}</textarea>
            </div>
            @error('content')
            <div class="alert alert-danger">メモ内容を入力してください！</div>
            @enderror

            <div class="mt-3">
                @foreach ($tags as $t)
                    <div class="form-check form-check-inline mb-3">
                        <input type="checkbox" class="form-check-input" name="tags[]" id="{{ $t->id }}"
                            value="{{ $t->id }}" {{in_array($t['id'], $include_tags) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $t->id }}">{{ $t->name }}</label>
                    </div>
                @endforeach
            </div>
            <input type="text" class="form-control w-50" name="new_tag" placeholder="新しいタグを入力">
            <button type="submit" class="btn btn-primary mt-3">更新</button>
        </form>
    </div>
@endsection
