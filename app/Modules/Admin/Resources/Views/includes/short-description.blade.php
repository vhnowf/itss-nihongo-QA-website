
<div class="form-group">
    <label for="short_description">{{ __('Mô tả ngắn') }}</label>
    <textarea name="short_description"
        id="short_description"
        class="form-control count_char"
        rows="3"
        maxlength=255
    >{{ old('short_description',  $dataEdit->short_description ?? null) }}</textarea>
</div>
