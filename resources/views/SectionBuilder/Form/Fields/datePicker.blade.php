<div class="form-group date">
    <label for="input_{{ $name }}">{{ $label }}</label>
    <input id="input_{{ $name }}"
           name="{{ $name }}"
           type="text"
           class="form-control datepicker"
           value="{{ $value }}"
           data-datepicker-format="{{ $format }}"
           data-datepicker-language="{{ $language }}"
           data-datepicker-todayBtn="{{ $todayBtn }}"
           data-datepicker-clearBtn="{{ $clearBtn }}"
           @if($required) required @endif>
</div>