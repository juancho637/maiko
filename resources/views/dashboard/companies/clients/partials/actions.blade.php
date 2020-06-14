@can('view client')
    <a href="{{ route('dashboard.companies.clients.show', [$company_id, $id]) }}" class="btn btn-xs btn-icon btn-info"><i class="fas fa-eye"></i></a>
@endcan
@can('edit clients')
    <a href="{{ route('dashboard.companies.clients.edit', [$company_id, $id]) }}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-pen"></i></a>
@endcan
@can('delete clients')
    <form method="POST" action="{{ route('dashboard.companies.clients.destroy', [$company_id, $id]) }}" style="display: inline">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar este rol?')" class="btn btn-xs btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
