@can('view role')
    <a href="{{ route('dashboard.roles.show', $id) }}" class="btn btn-xs btn-icon btn-info"><i class="fas fa-eye"></i></a>
@endcan
@can('edit roles')
    <a href="{{ route('dashboard.roles.edit', $id) }}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-pen"></i></a>
@endcan
@can('delete roles')
    <form method="POST" action="{{ route('dashboard.roles.destroy', $id) }}" style="display: inline">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar este rol?')" class="btn btn-xs btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
