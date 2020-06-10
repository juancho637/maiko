@can('create cities')
    <a href="{{ route('dashboard.cities.show', $id) }}" class="btn btn-xs btn-icon btn-info"><i class="fas fa-eye"></i></a>
@endcan
@can('edit cities')
    <a href="{{ route('dashboard.cities.edit', $id) }}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-pen"></i></a>
@endcan
@can('delete cities')
    <form method="POST" action="{{ route('dashboard.cities.destroy', $id) }}" style="display: inline">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar esta ciudad?')" class="btn btn-xs btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
