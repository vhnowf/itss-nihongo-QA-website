{{ $datas->appends(request()->query())->links('pagination::bootstrap-4') }}
<div>{{ $datas->toArray()['from'] }}-{{ $datas->toArray()['to']  }} / {{ $datas->total() }}</div>
