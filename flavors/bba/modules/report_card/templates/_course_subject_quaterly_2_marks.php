<?php
/*
 * Kimkëlen - School Management Software
 * Copyright (C) 2013 CeSPI - UNLP <desarrollo@cespi.unlp.edu.ar>
 *
 * This file is part of Kimkëlen.
 *
 * Kimkëlen is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License v2.0 as published by
 * the Free Software Foundation.
 *
 * Kimkëlen is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Kimkëlen.  If not, see <http://www.gnu.org/licenses/gpl-2.0.html>.
 */ ?>
<div class="title"><?php echo __('Marks') ;?></div>
<table class="gridtable">
	<tr>

		<th class='th-subject-name'><?php echo __('Anuales (Rég. Cuatrimestral)') ?></th>
		<th><?php echo __('1°C') ?></th>
		<th><?php echo __('2°C') ?></th>
		<th><?php echo __('Prom. Final') ?></th>
		<th><?php echo __('Ex R.') ?></th>
		<th><?php echo __('Ex C.') ?></th>
		<th><?php echo __('Ex P.') ?></th>
		<th><?php echo __('Prom. Def.') ?></th>


	</tr>
	<?php foreach ($course_subject_students as $course_subject_student): ?>
		<tr>
			<td class='subject_name'><?php echo $course_subject_student->getCourseSubject()->getCareerSubject()->getSubject()->getName() ?></td>
			<td><?php echo $course_subject_student->getMarkForIsClosed(1) ?></td>
			<td><?php echo $course_subject_student->getMarkForIsClosed(2) ?></td>
			<td><?php echo ($course_result = $course_subject_student->getCourseResult()) ? $course_result->getResultStr() : '' ?></td>
			<td><?php echo (($course_result instanceOf StudentDisapprovedCourseSubject) && $course_subject_student_examination = $course_subject_student->getCourseSubjectStudentExaminationsForExaminationNumber(1)) ? $course_subject_student_examination->getMarkStr() : '' ?></td>
			<td><?php echo (($course_result instanceOf StudentDisapprovedCourseSubject) && $course_subject_student_examination = $course_subject_student->getCourseSubjectStudentExaminationsForExaminationNumber(2)) ? $course_subject_student_examination->getMarkStr() : '' ?></td>
			<?php if (!is_null($student_repproved_course_subject = $course_subject_student->repprovedCourseSubjectHasBeenApproved())): ?>
				<td><?php echo ($student_repproved_course_subject->getLastMarkStr()) ?></td>
			<?php else: ?>
				<td></td>
			<?php endif; ?>

			<td> 
                        
                            <?php if( !is_null($course_result) && $course_result->getCourseSubjectStudent()->getIsNotAverageable() && ! is_null($course_result->getCourseSubjectStudent()->getNotAverageableCalification())): ?>
                                <?php if($course_result->getCourseSubjectStudent()->getNotAverageableCalification() == NotAverageableCalificationType::APPROVED): ?>
                                  <?php echo __("Trayectoria completa"); ?>
                                <?php elseif($course_result->getCourseSubjectStudent()->getNotAverageableCalification()  == NotAverageableCalificationType::DISAPPROVED): ?>  
                                    <?php echo __("Trayectoria en curso"); ?>
                                <?php else: ?>
                                       <?php echo __($course_result->getCourseSubjectStudent()->getNotAverageableCalification(); ?>
                                <?php endif; ?>

                              <?php else: ?> 
                              <?php echo $student->getPromDef($course_result) ?>
                              <?php endif ?>
                        </td>

		</tr>
	<?php endforeach; ?>
</table>
