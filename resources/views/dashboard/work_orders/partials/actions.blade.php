@can('view work order')
    <a href="{{ route('dashboard.work_orders.show', $id) }}" class="btn btn-xs btn-icon btn-info"><i class="fas fa-eye"></i></a>
@endcan
@can('edit work orders')
    <a href="{{ route('dashboard.work_orders.edit', $id) }}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-pen"></i></a>
@endcan
@can('delete work orders')
    <form method="POST" action="{{ route('dashboard.work_orders.destroy', $id) }}" style="display: inline">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar esta order de trabajo?')" class="btn btn-xs btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
