<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/20/2017
 * Time: 4:56 PM
 */

require_once ('common/html_open.php');

require_once ('common/head_open.php');
require_once ('common/meta.php');
require_once ('common/link_css.php');
require_once ('dashboard/dashboard_common_css.php');
require_once ('plugins/datatables_css.php');
require_once ('plugins/export_pdf_excel_ect_css.php');
require_once ('plugins/bootstrap_datetimepicker_css.php');
require_once ('plugins/bootstrap_select_css.php');
require_once ('plugins/datatables_custom_css.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');

require_once ('dashboard/dashboard_main_container_open.php');
require_once ('dashboard/dashboard_left_side_content.php');
require_once ('dashboard/dashboard_top_navigation.php');

require_once ('dashboard/dashboard_main_content_open.php');

if($cus_id == 0)
{
    //echo "if"; exit;
    require_once ('report/transation_all_report_table_list.php');
}
else
{
    //echo "else"; exit;
    require_once('report/transation_report_table_list.php');
}

require_once ('dashboard/dashboard_main_content_close.php');

require_once ('dashboard/dashboard_main_container_close.php');

require_once ('common/link_js.php');
require_once ('dashboard/dashboard_common_js.php');
require_once ('plugins/datatables_js.php');
require_once ('plugins/export_pdf_excel_ect_js.php');

require_once ('plugins/bootstrap_datetimepicker_js.php');
require_once ('plugins/bootstrap_select_js.php');
             // datatable Javascript
require_once ('report/transation_datatables_js.php');
require_once ('common/body_close.php');

require_once ('common/html_open.php');
require_once ('product/modal_window_product.php');
?>
