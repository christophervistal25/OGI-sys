<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendGrade extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $student;

    protected $subjects;

    protected $studentLevel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student, $subjects, $studentLevel)
    {
        $this->student = $student;
        $this->subjects = $subjects;
        $this->studentLevel = $studentLevel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $student = $this->student;
        $subjects = $this->subjects;
        $level = $this->studentLevel;

        return $this->view('admin.student-grade.email-template', compact('student', 'subjects', 'level'));
    }
}
