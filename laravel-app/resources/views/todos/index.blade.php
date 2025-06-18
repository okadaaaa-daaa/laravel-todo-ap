@extends('layouts.app')

@section('title', 'TODO一覧')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>TODO一覧</h1>
    <a href="{{ route('todos.create') }}" class="btn btn-success">新しいTODOを追加</a>
</div>

@if($todos->count() > 0)
    <div class="row">
        @foreach($todos as $todo)
            <div class="col-md-6 mb-3">
                <div class="card {{ $todo->completed ? 'border-success' : '' }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title {{ $todo->completed ? 'text-decoration-line-through text-muted' : '' }}">
                                    {{ $todo->title }}
                                </h5>
                                @if($todo->description)
                                    <p class="card-text {{ $todo->completed ? 'text-muted' : '' }}">
                                        {{ $todo->description }}
                                    </p>
                                @endif
                                <small class="text-muted">作成日: {{ $todo->created_at->format('Y/m/d H:i') }}</small>
                            </div>
                            <div class="ms-3">
                                @if($todo->completed)
                                    <span class="badge bg-success">完了</span>
                                @else
                                    <span class="badge bg-warning">未完了</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $todo->completed ? 'btn-warning' : 'btn-success' }}">
                                    {{ $todo->completed ? '未完了にする' : '完了にする' }}
                                </button>
                            </form>
                            
                            <a href="{{ route('todos.edit', $todo) }}" class="btn btn-sm btn-primary">編集</a>
                            
                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-5">
        <h3 class="text-muted">TODOがありません</h3>
        <p class="text-muted">新しいTODOを追加してみましょう！</p>
        <a href="{{ route('todos.create') }}" class="btn btn-success">TODOを追加</a>
    </div>
@endif
@endsection
