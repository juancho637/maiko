@can('view corrosion')
    <a href="{{ $view }}" class="btn btn-xs btn-icon btn-info"><i class="fas fa-eye"></i></a>
@endcan
@can('edit corrosions')
    <a href="{{ $edit }}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-pen"></i></a>
@endcan
@can('delete corrosions')
    <form method="POST" action="{{ $delete }}" style="display: inline">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar esta corrosión?')" class="btn btn-xs btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
