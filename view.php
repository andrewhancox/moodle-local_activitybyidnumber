<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package local_activitybyidnumber
 * @author Andrew Hancox <andrewdchancox@googlemail.com>
 * @author Open Source Learning <enquiries@opensourcelearning.co.uk>
 * @link https://opensourcelearning.co.uk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright 2025, Andrew Hancox
 */

require_once(__DIR__ . '/../../config.php');

$idnumber = required_param('idnumber', PARAM_RAW);

$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/local/activitybyidnumber/view.php'));

$cm = cm_info::create($DB->get_record('course_modules', ['idnumber' => $idnumber]));

if (empty($cm)) {
    redirect(new moodle_url('/'));
} else if (empty($cm->url)) {
    redirect(new moodle_url("/course/view.php", [
        'id' => $cm->course,
        'sectionid' => $cm->section,
    ]));
} else {
    redirect($cm->url);
}
