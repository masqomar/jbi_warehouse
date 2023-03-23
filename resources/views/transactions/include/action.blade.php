<td>
    @can('view room')
    <a href="{{ route('transactions.show', $model->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    @endcan
</td>