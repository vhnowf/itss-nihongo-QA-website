<div class="l-pagination right">
    {{ $datas->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>