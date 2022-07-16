<div class="form-group">
    <label>{{ (isset($contentTitle)) ? $contentTitle :__('nội dung') }} *</label>

    @if ($errors->has('content'))
        <div>
            <span class="help-block">
                <small class="text-danger">{{ $errors->first('content') }}</small>
            </span>
        </div>
    @endif

    <div class="m-b-5">
        <button type="button" class="btn btn-light" onclick="initMediaEditor(contentEditor)"><i class="fa fa-music" aria-hidden="true"></i> {{ __('Media') }}</button>
        {{-- <button type="button" class="btn btn-light" onclick="initMediaArticleExample(contentEditor)"><i class="fa fa-file" aria-hidden="true"></i> {{ __('Bài viết mẫu') }}</button> --}}
    </div>
    <textarea name="content" class="form-control" id="content" rows="5">{{ old('content',  $dataEdit->content ?? null) }}</textarea>
</div>
