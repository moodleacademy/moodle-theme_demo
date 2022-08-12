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
 * Overriden theme boost core renderer.
 *
 * @package    theme_demo
 * @copyright  2017 Rajneel Totaram
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_demo\output;

use html_writer;
use moodle_url;
use theme_boost\output\core_renderer as core_renderer_base;



defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/theme/demo/locallib.php');

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_demo
 * @copyright  2017 Rajneel Totaram
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends core_renderer_base {

    public function edit_button(moodle_url $url, string $method = 'post') {
        if ($this->page->theme->haseditswitch == true) {
            return;
        }

        $url->param('sesskey', sesskey());
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $class = 'edit_off';
            $editstring = get_string('turneditingoff');
        } else {
            $url->param('edit', 'on');
            $class = 'edit_on';
            $editstring = get_string('turneditingon');
        }

        return $this->single_button($url, $editstring, 'post', array('class' => $class));
    }

    /**
     * Create a navbar switch for toggling editing mode.
     *
     * @return string Html containing the edit switch
     */
    public function edit_switch() {
        if ($this->page->user_allowed_editing() && $this->page->theme->haseditswitch) {

            $temp = (object) [
                'legacyseturl' => (new moodle_url('/editmode.php'))->out(false),
                'pagecontextid' => $this->page->context->id,
                'pageurl' => $this->page->url,
                'sesskey' => sesskey(),
            ];
            if ($this->page->user_is_editing()) {
                $temp->checked = true;
            }
            return $this->render_from_template('core/editswitch', $temp);
        }
    }
}
