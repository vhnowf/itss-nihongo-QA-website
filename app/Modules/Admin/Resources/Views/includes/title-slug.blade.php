<div class="form-group">
    <label for="title">{{ isset($title_name) ? $title_name : __('Tiêu đề') }} <small>({{ __('Tổng số ký tự') }}: <span class="count_total"></span>)</small> *</label>
    <input type="text"
        name="title" id="title"
        placeholder="{{ isset($title_name) ? $title_name : __('Tiêu đề') }}"
        class="form-control count_char {{ $errors->has('title') ? ' is-invalid' : '' }}"
        value="{{ old('title',  $dataEdit->title ?? null) }}"
        maxlength=255
    />
    @if ($errors->has('title'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('title') }}</small>
        </span>
    @endif
</div>

<div class="form-group">
    <label for="slug">{{ __('Slug') }} <small>({{ __('Tổng số ký tự') }}: <span class="count_total"></span>)</small> *</label>
    <input type="text"
        name="slug"
        id="slug"
        placeholder="{{ __('Slug') }}"
        class="form-control count_char {{ $errors->has('slug') ? ' is-invalid' : '' }}"
        value="{{ old('slug', $dataEdit->slug ?? null) }}"
        maxlength=255
    />
    @if ($errors->has('slug'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('slug') }}</small>
        </span>
    @endif
</div>
<script>
    $('input[name=title]').keyup(function() {
        $('input[name=slug]').val(stringToSlug(this.value));
        $('input[name=slug]').trigger('keyup');
    });
</script>
