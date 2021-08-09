<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\CourseClass;
use App\Models\ClassComment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseClassClassCommentsDetail extends Component
{
    use AuthorizesRequests;

    public CourseClass $courseClass;
    public ClassComment $classComment;
    public $courseClassComments = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ClassComment';

    protected $rules = [
        'classComment.name' => ['required', 'max:255', 'string'],
        'classComment.comment_id' => ['required', 'exists:comments,id'],
    ];

    public function mount(CourseClass $courseClass)
    {
        $this->courseClass = $courseClass;
        $this->courseClassComments = Comment::pluck('name', 'id');
        $this->resetClassCommentData();
    }

    public function resetClassCommentData()
    {
        $this->classComment = new ClassComment();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newClassComment()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.course_class_class_comments.new_title');
        $this->resetClassCommentData();

        $this->showModal();
    }

    public function editClassComment(ClassComment $classComment)
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.course_class_class_comments.edit_title'
        );
        $this->classComment = $classComment;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->classComment->course_class_id) {
            $this->authorize('create', ClassComment::class);

            $this->classComment->course_class_id = $this->courseClass->id;
        } else {
            $this->authorize('update', $this->classComment);
        }

        $this->classComment->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', ClassComment::class);

        ClassComment::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetClassCommentData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->courseClass->classComments as $classComment) {
            array_push($this->selected, $classComment->id);
        }
    }

    public function render()
    {
        return view('livewire.course-class-class-comments-detail', [
            'classComments' => $this->courseClass
                ->classComments()
                ->paginate(20),
        ]);
    }
}
