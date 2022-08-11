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


    /**
     * This renders the navbar.
     * Uses bootstrap compatible html.
     */
    public function navbar(): string {

        global $CFG;

        $items = $this->page->navbar->get_items();
        $itemcount = count($items);
        if ($itemcount === 0) {
            return '';
        }

        unset($items[0]); // Remove first item.

        // Add Home icon as first item.
        $breadcrumbs = '<li class="breadcrumb-item">'
            . '<a href="' . $CFG->wwwroot . '/my/" title="' . get_string('home') . '">'
            . '<i class="fa fa-home fa-lg" id="homeicon"></i>'
            . '</a>'
            . '</li>';

        // Go over all items.
        foreach ($items as $item)
		{
			if ($item->type == "0" || $item->type == "30" /*|| $item->type == "60"*/)
			{
                continue;
            }

            $item->hideicon = true;
			$item->title = $item->text; // Put text here, in case it may be trimmed.

			// Trim long items so that they don't spill over.
			if(strlen($item->text) > 25)
			{
				$item->text = substr($item->text, 0, 20) . "...";
			}

            $breadcrumbs .= '<li class="breadcrumb-item">' . $this->render($item) . '</li>';
        }

        $navbarcontent = html_writer::start_tag('nav',
            array('aria-label' => get_string('breadcrumb', 'access'),
                'role' => 'navigation'))
			. html_writer::tag('ol', "$breadcrumbs", array('class' => 'breadcrumb'))
			. html_writer::end_tag('nav');

        return $navbarcontent;

        //return $this->render_from_template('core/navbar', $this->page->navbar);
    }

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

}
