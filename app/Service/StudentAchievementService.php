<?php

namespace App\Service;

use App\Student;
use App\StudentAchievement;

class StudentAchievementService
{
    public function addAchievements(array $data, Student $student)
    {
        $achievements = array_filter($data['achievements']);
        if (count($achievements) !== 0) {
            foreach ($achievements as $achievement) {
                $studentAchievements[] = new StudentAchievement([
                    'achievement' => $achievement,
                ]);
            }
            $student->achievements()->saveMany($studentAchievements);
        }
    }
}
