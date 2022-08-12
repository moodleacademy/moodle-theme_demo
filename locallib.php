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
 * Utility functions used within the theme
 *
 * @package    theme_demo
 * @copyright  2022 Rajneel Totaram
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 /**
 * Display some extra message.
 */
function theme_demo_extra_message() {
    return html_writer::start_tag('div', array('class' => 'card text-white bg-primary'))
    . html_writer::start_tag('div', array('class' => 'card-body'))
    . html_writer::start_tag('h5', array('class' => 'card-title'))
    . get_string('demo_card_title', 'theme_demo')
    . html_writer::end_tag('h5')
    . html_writer::start_tag('div', array('class' => 'card-text'))
    . get_string('demo_message', 'theme_demo')
    . html_writer::end_tag('div')
    . html_writer::end_tag('div')
    . html_writer::end_tag('div');
}
