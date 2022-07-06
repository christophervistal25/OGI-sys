<div class="text-center">
	<a href="{{ route('subject.edit', [$subject->id]) }}" class="btn btn-success btn-sm text-center mr-2 rounded-circle shadow">
        <i class="fa fa-pen"></i>
    </a>
    <button class='btn btn-sm btn-danger rounded-circle shadow btn-remove-subject' data-id="{{ $subject->id }}">
        <i class='fa fa-trash'></i>
    </button>
</div>
