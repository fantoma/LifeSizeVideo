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
 * This plugin is used to access files on server file system
 *
 * @since Moodle 2.0
 * @package    repository_lifesizevideo
 * @copyright  2015 Diego Fantoma {@link http://www.fantoma.it}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//require_once($CFG->dirroot . '/repository/lib.php');
//require_once($CFG->libdir . '/filelib.php');

/**
 * repository_lifesizevideo class
 *
 * Create a repository from your local filesystem
 * *NOTE* for security issue, we use a fixed repository path
 * which is %moodledata%/repository
 *
 * @package    repository
 * @copyright  2015 Diego Fantoma {@link http://www.fantoma.it}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->dirroot . '/repository/lib.php');


class repository_lifesizevideo extends repository {


    public function __construct($repositoryid, $context = SYSCONTEXTID, $options = array()) {
        parent::__construct($repositoryid, $context, $options);
    }



    /**
     * LifeSizeVideo plugin doesn't support global search
     */
    public function global_search() {
        return false;
    }

    public function get_listing($path='', $page = '') {
        return array();
    }

    /**
     * file types supported by youtube plugin
     * @return array
     */
    public function supported_filetypes() {
        return array('video');
    }

    /**
     * LifeSizeVideo plugin only return external links
     * @return int
     */
    public function supported_returntypes() {
        return FILE_EXTERNAL;
    }

    /**
     * Is this repository accessing private data?
     *
     * @return bool
     */
    public function contains_private_data() {
        return false;
    }

    /**
     * Return search results
     * @param string $search_text
     * @return array
     */
    public function search($search_text, $page = 0) {

     $list=array();

     $list[] = array(
                    'shorttitle' => 'short1',
                    'thumbnail_title' => 'thunbtit1',
                    'title' => 'title1'.'.avi', // This is a hack so we accept this file by extension.
                    'thumbnail' => 'https://videocenter.units.it/recordings/by-date/2015/12/03/disu-quazzolo-03-december-2015-09-17/thumb-small.jpg',
                    'thumbnail_width' => 160,
                    'thumbnail_height' => 89,
                    'size' => '',
                    'date' => '',
                    'source' => 'https://videocenter.units.it/videos/video/319/?access_token=shr00000003197989551216533601882395772621734',
                );
     $list[] = array(
                    'shorttitle' => 'short2',
                    'thumbnail_title' => 'thunbtit2',
                    'title' => 'title2'.'.avi', // This is a hack so we accept this file by extension.
                    'thumbnail' => 'https://videocenter.units.it/recordings/by-date/2015/12/04/disu-quazzolo-04-december-2015-09-15/thumb-small.jpg',
                    'thumbnail_width' => 160,
                    'thumbnail_height' => 89,
                    'size' => '',
                    'date' => '',
                    'source' => 'https://videocenter.units.it/videos/video/320/?access_token=shr00000003203289507228590833133789845198485',
                );

      $ret  = array();
      $ret['nologin'] = true;
      $ret['page'] = 1;
      $ret['list'] = $list;
      $ret['norefresh'] = true;
      $ret['nosearch'] = true;
      $ret['pages'] = 1;
      return $ret;




    }

    /**
     * Generate search form
     */
    public function print_login($ajax = true) {
        $ret = array();
        $search = new stdClass();
        $search->type = 'text';
        $search->id   = 'lifesizevideo_search';
        $search->name = 's';
        $search->label = 'this is the search label'.': ';
        $sort = new stdClass();
        $sort->type = 'select';
        $sort->options = array(
            (object)array(
                'value' => 'relevance',
                'label' => 'rilevanza'
            ),
            (object)array(
                'value' => 'date',
                'label' => 'data'
            ),
            (object)array(
                'value' => 'rating',
                'label' => 'rafting'
            ),
            (object)array(
                'value' => 'viewCount',
                'label' => 'viewcunt'
            )
        );
        $sort->id = 'lifesizevideo_sort';
        $sort->name = 'lifesizevideo_sort';
        $sort->label = 'sortbylabel'.': ';
        $ret['login'] = array($search, $sort);
        $ret['login_btn_label'] = get_string('search');
        $ret['login_btn_action'] = 'search';
        $ret['allowcaching'] = true; // indicates that login form can be cached in filepicker.js
        return $ret;
    }


// FINE CLASSE

}
