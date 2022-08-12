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
 * Trait - format section
 * Code that is shared between course_format_topic_renderer.php and course_format_weeks_renderer.php
 * Used for section outputs.
 *
 * @package    theme_demo
 * @copyright  2018 Rajneel Totaram
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_demo\output;

defined('MOODLE_INTERNAL') || die();

use context_course;
use html_writer;
use moodle_url;
use completion_info;
use stdClass;

trait format_section_trait {

    public function render_content($output) {
        global $COURSE;

        $format = course_get_format($COURSE);
        $outputclass = $format->get_output_classname('content');
        $widget = new $outputclass($format);

        $data = $widget->export_for_template($this);
        $data->extrablock = theme_demo_extra_message();

        return $this->render_from_template('theme_demo/core_courseformat/local/content', $data);
   }
}
