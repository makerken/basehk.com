<form method="POST" action="/lists">
    @csrf
    <div class="form-group">
        <input type="text" name="title" class="form-control" required placeholder="List title" value="{{ old('title') }}">
    </div>
    <div class="form-group">
        <textarea rows="14" name="words" class="form-control" required placeholder="word list">{{ old('words') }}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Create list</button>
    </div>
    @include('errors')
</form>