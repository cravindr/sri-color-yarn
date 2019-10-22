<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/20/2017
 * Time: 12:43 PM
 */

require_once ('common/html_open.php');

require_once ('common/head_open.php');
require_once ('common/meta.php');
require_once ('common/link_css.php');
require_once ('dashboard/dashboard_common_css.php');
require_once ('plugins/bootstrap_select_css.php');
require_once ('plugins/bootstrap_fileinput_css.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');

require_once ('dashboard/dashboard_main_container_open.php');
require_once ('dashboard/dashboard_left_side_content.php');
require_once ('dashboard/dashboard_top_navigation.php');

require_once ('dashboard/dashboard_main_content_open.php');
//require_once ('dashboard/dashboard_top_tiles.php');

if($listform == "brachform")
{
    require_once('company/branch/add_company_branch_form.php');
}
else
{
    if($company_already_exists == 1)
    {
        require_once ('company/add_company_edit_form.php');
    }
    else
    {
        require_once ('company/add_company_form.php');
    }

}

require_once ('dashboard/dashboard_main_content_close.php');

require_once ('dashboard/dashboard_main_container_close.php');

require_once ('common/link_js.php');
require_once ('dashboard/dashboard_common_js.php');
require_once ('plugins/bootstrap_select_js.php');
require_once ('plugins/bootstrap_fileinput_js.php');
require_once ('company/company_link_js.php');
require_once ('common/body_close.php');

require_once ('common/html_close.php');
?>


