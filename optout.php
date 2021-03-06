<?php
// This file is part of the plagaware plugin for Moodle - http://moodle.org/
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
 * Allows students to opt-out of plagiarism detection
 *
 * @package    plagiarism_plagaware
 * @author     Davo Smith
 * @copyright  @2012 Synergy Learning
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__).'/../../config.php');

$optout = required_param('optout', PARAM_BOOL);
$return = urldecode(required_param('return', PARAM_TEXT));

$PAGE->set_url($return);
if ($CFG->version < 2011120100) {
    $context = get_context_instance(CONTEXT_SYSTEM);
} else {
    $context = context_system::instance();
}
$PAGE->set_context($context);

require_login();
require_sesskey();

set_user_preference('plagiarism_plagaware_optout', $optout);

$PAGE->set_title(get_string('pluginname', 'plagiarism_plagaware'));
if ($optout) {
    $PAGE->set_heading(get_string('optout', 'plagiarism_plagaware'));
    $msg = get_string('optout_explanation', 'plagiarism_plagaware');
} else {
    $PAGE->set_heading(get_string('optin', 'plagiarism_plagaware'));
    $msg = get_string('optin_explanation', 'plagiarism_plagaware');
}

echo $OUTPUT->header();
notice($msg, $return);
