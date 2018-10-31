<div class="card w-100">
    <img class="card-img-top img-fluid" src="{{ $file->url ?? null }}" alt="">
    <div class="card-body">
        <input type="file" name="path" id="path" @if(!isset($file)) required @endif>
    </div>
</div>