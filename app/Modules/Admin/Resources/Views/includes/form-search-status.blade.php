<div class="form-group">
    <label>{{ __('Trạng thái') }}</label>
    <?php $statusSearch = request('status'); ?>
    <select name="status" class="form-control form-custom">
        <option value="all" selected>{{ __('Tất cả') }}</option>
        @foreach ( Config::get('config.list_status') as $key => $status)
            <option value="{{ $key }}" {{ ($statusSearch == $key) ? 'selected' : '' }}>{{ __($status) }}</option>  
        @endforeach
    </select>
</div>
