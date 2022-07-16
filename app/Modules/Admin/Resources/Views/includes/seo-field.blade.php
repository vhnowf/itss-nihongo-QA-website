<div class="form-group">
    <label for="seo_title">{{ __('Seo Title') }} <small>({{ __('Tổng số ký tự') }}: <span class="count_total"></span>)</small></label>
    <input type="text"
        name="seo_title"
        id="seo_title"
        class="form-control count_char"
        placeholder="{{ __('Seo Title') }}"
        value="{{ old('seo_title',  $dataEdit->seo_title ?? null) }}"
        maxlength=255
    />
</div>
<div class="form-group">
    <label for="seo_keywords">{{ __('Seo Keywords') }} <small>({{ __('Tổng số ký tự') }}: <span class="count_total"></span>)</small></label>
    <input type="text"
        name="seo_keywords"
        id="seo_keywords"
        class="form-control count_char"
        placeholder="{{ __('Seo Keywords') }}"
        value="{{ old('seo_keywords',  $dataEdit->seo_keywords ?? null) }}"
        maxlength=255
    />
</div>
<div class="form-group">
    <label for="seo_description">{{ __('Seo Description') }} <small>({{ __('Tổng số ký tự') }}: <span class="count_total"></span>)</small></label>
    <textarea name="seo_description"
        id="seo_description"
        class="form-control count_char"
        rows="3"
        maxlength=255
    >{{ old('seo_description',  $dataEdit->seo_description ?? null) }}</textarea>
</div>

<link href="{{ asset('admins/plugin/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ asset('admins/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

<script>
    $("#seo_keywords").tagsinput('items');
</script>
