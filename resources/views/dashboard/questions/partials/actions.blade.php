@can('view question')
    <a href="{{ route('dashboard.questions.show', $id) }}" class="btn btn-xs btn-icon btn-info"><i class="fas fa-eye"></i></a>
@endcan
@can('edit questions')
    <a href="{{ route('dashboard.questions.edit', $id) }}" class="btn btn-xs btn-icon btn-warning"><i class="fas fa-pen"></i></a>
@endcan
@can('delete questions')
    <form method="POST" action="{{ route('dashboard.questions.destroy', $id) }}" style="display: inline">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar esta pregunta?')" class="btn btn-xs btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
    </form>
@endcan
