<select name="{{ $name }}" class="form-control filter-input">
    @foreach($options as $key => $option)
        <option value="{{ $key }}">{{ $option }}</option>
    @endforeach
</select>