@can('download inspection cert')
    @if ($status['name'] === 'aprobada')
        <a href="{{ route('dashboard.inspections.approved', $id) }}" class="btn btn-xs btn-icon btn-secondary"><i class="fas fa-download"></i></a>
    @elseif($status['name'] === 'rechazada')
        <a href="{{ route('dashboard.inspections.rejected', $id) }}" class="btn btn-xs btn-icon btn-secondary"><i class="fas fa-download"></i></a>
    @endif
@endcan
@can('view inspection')
    <a href="{{ route('dashboard.work_orders.inspections.show', [$work_order_id, $id]) }}" class="btn btn-xs btn-icon btn-info"><i class="fas fa-eye"></i></a>
@endcan
@can('edit inspections')
    <a href="{{ route('dashboard.work_orders.inspections.edit', [$work_order_id, $id]) }}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-pen"></i></a>
@endcan
@can('delete inspections')
    <form method="POST" action="{{ route('dashboard.work_orders.inspections.destroy', [$work_order_id, $id]) }}" style="display: inline">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar esta order de trabajo?')" class="btn btn-xs btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
