@can('view user')
    <a href="{{ route('dashboard.users.show', $id) }}" class="btn btn-xs btn-icon btn-info"><i class="fas fa-eye"></i></a>
@endcan
@can('edit users')
    <a href="{{ route('dashboard.users.edit', $id) }}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-pen"></i></a>
@endcan
@can('delete users')
    <form method="POST" action="{{ route('dashboard.users.destroy', $id) }}" style="display: inline">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar este usuario?')" class="btn btn-xs btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
