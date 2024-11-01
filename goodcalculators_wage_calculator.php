<?php
/*
Plugin Name: Wage Conversion Calculator
Plugin URI: https://goodcalculators.com/annual-salary-calculator/
Description: This calculator will assist you to rapidly change your net pay set in a single periodic time period (hourly, every day, weekly, and many others) to its related set amount in all other usual periodic terms. This calculator can be inserted either to the sidebar or into the post, but not both. Install "Wage Conversion Calculator" through the WordPress admin menu of Design or Appearance and then widgets to add to the sidebar. Place [goodcalculators_wage_calculator] in the content to insert into a post.
Author: goodcalculators.com
Version: 1.0
Author URI: https://goodcalculators.com
License: GNU GPL see http://www.gnu.org/licenses/licenses.html#GPL
*/

class goodcalculators_wage_calculator {

    function calc_init() {
    	$class_name = 'goodcalculators_wage_calculator';
    	$calc_title = 'Wage Conversion Calculator';
    	$calc_desc = 'This calculator will assist you to rapidly change your net pay set in a single periodic time period to its related set amount in all other usual periodic terms.';

    	if (!function_exists('wp_register_sidebar_widget')) return;

    	wp_register_sidebar_widget(
    		$class_name,
    		$calc_title,
    		array($class_name, 'calc_widget'),
            array(
            	'classname' => $class_name,
            	'description' => $calc_desc
            )
        );

    	wp_register_widget_control(
    		$class_name,
    		$calc_title,
    		array($class_name, 'calc_control'),
    	    array('width' => '100%')
        );

        add_shortcode(
        	$class_name,
        	array($class_name, 'calc_shortcode')
        );
    }

    function calc_display($is_widget, $args=array()) {
    	if($is_widget){
    		extract($args);
			$options = get_option('goodcalculators_wage_calculator');
			$title = $options['title'];
			$output[] = $before_widget . $before_title . $title . $after_title;
		}


		$output[] = '<div style="margin-top:5px;">
			<script type="text/javascript">

function cFuncToAddComm(FmSt) {
            FmSt = parseFloat(FmSt).toFixed(2);
            FmSt += "";
            x = FmSt.split(".");
            x1 = x[0];
            x2 = x.length > 1 ? "." + x[1] : "";
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, "$1" + "," + "$2");
            }
            return x1 + x2;
        }

function cwage_salary_calc()  {

      var CURRCY = "";
	  CURRCY = "&#36;";

      var WageAnn = 0;
      var WageVal = document.getElementById("cwage").value;	  
      var PeriodVal = document.getElementById("cperiod").value;	  
      var WeekHoursVals = document.getElementById("cweekHours").value;	  
      var Work_daysVal = document.getElementById("cweekDays").value;	

      if(PeriodVal == 0) {
         WageAnn = WageVal * WeekHoursVals * 52;		 
	  } else
      if(PeriodVal == 1) {
         WageAnn = (WageVal * Work_daysVal * 52); 
      } else
      if(PeriodVal == 2) {
         WageAnn = WageVal * 52;
      } else
      if(PeriodVal == 3) {
         WageAnn = WageVal * 26;
      } else
      if(PeriodVal == 4) {
         WageAnn = WageVal * 24;
      } else
      if(PeriodVal == 5) {
         WageAnn = WageVal * 12;
      } else
      if(PeriodVal == 6) {
         WageAnn = WageVal * 4;
      } else
      if(PeriodVal == 7) {
         WageAnn = WageVal;
      }


      HourlyRes = WageAnn / 52 / WeekHoursVals;
      document.getElementById("cres7").innerHTML = CURRCY + cFuncToAddComm(HourlyRes);	  
	  DailyRes = WageAnn / 52 / Work_daysVal;
      document.getElementById("cres8").innerHTML = CURRCY + cFuncToAddComm(DailyRes);
      WeeklyRes = WageAnn / 52;
      document.getElementById("cres6").innerHTML = CURRCY + cFuncToAddComm(WeeklyRes);
      BiWeeklyRes = WageAnn / 26;
      document.getElementById("cres5").innerHTML = CURRCY + cFuncToAddComm(BiWeeklyRes);
      SemiMonthlyRes = WageAnn / 24;
      document.getElementById("cres4").innerHTML = CURRCY + cFuncToAddComm(SemiMonthlyRes);
      MonthlyRes = WageAnn / 12;
      document.getElementById("cres3").innerHTML = CURRCY + cFuncToAddComm(MonthlyRes);
      QuarterlyRes = WageAnn / 4;
      document.getElementById("cres2").innerHTML = CURRCY + cFuncToAddComm(QuarterlyRes);
      AnnuallyRes = WageAnn;
      document.getElementById("cres1").innerHTML = CURRCY + cFuncToAddComm(AnnuallyRes);	  
}


        function cEmptyAllVal() {
            var txt = "";
                txt = document.getElementById("cres1");
                txt.innerHTML = "";
                txt = document.getElementById("cres2");
                txt.innerHTML = "";
                txt = document.getElementById("cres3");
                txt.innerHTML = "";
                txt = document.getElementById("cres4");
                txt.innerHTML = "";
                txt = document.getElementById("cres5");
                txt.innerHTML = "";
				txt = document.getElementById("cres6");
                txt.innerHTML = "";
				txt = document.getElementById("cres7");
                txt.innerHTML = "";     
				txt = document.getElementById("cres8");
                txt.innerHTML = "";   				
        }
			</script>

			<!-- Edit to change the look & feel of this calculator -->
   <style>
		#tbl {
		font-size:12px; 
		font-family:Arial,sans-serif;
		background: #F5F5F5; 
		width:240px; 
		border:1px solid  #1991D0;}		
		#tbl #tex {color:#222222;}		
		#tbl td {padding:5px 2px 0px 5px; font-family:Arial,sans-serif; color:#000000; }
		#tbl .right {padding:3px 5px 0 0; text-align:right}
		#tbl .detail {padding:1px 5px 5px 6px; text-align:right;}
		#tbl #border_bt {padding:2px 5px 2px 6px; background: #1991D0; color: #fff;}
		#tbl #border_bt a {color: #fff;}
		#lnk {color:#000000;} 
		#tbl td#lnkd{color:#000000;}
		#border_bt_link {text-decoration:none;}
		input[type=number], label {padding: 3px 3px;}
		* {margin: 0;padding: 0;}
	</style>
					
<table cellpadding="0" cellspacing="0" border="0" id="tbl" height="100%">
<tr>   
<td id="tex" colspan="2">

<b>Wage&nbsp;Conversion&nbsp;Calculator<br>
<span id="dvds"></span></b>
<span style="height:1; Filter: Alpha(Opacity=50)" id="date_update"></span>
</td>
</tr>

<tr id="tex1">
<td>

<label for="cwage">Enter Wage &nbsp;<span id="ccurprop">&#36;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
<input type="number" step="any" id="cwage" name="cwage" min="0" value="25" onChange="cwage_salary_calc();" />

<p>&nbsp;</p>

<label for="cperiod">Select Pay Period</label> 
 <select id="cperiod" name="cperiod" size="1" onChange="cwage_salary_calc();">
 <option value="0">Hourly</option>
 <option value="1">Daily</option>
 <option value="2">Weekly</option>
 <option value="3">Bi-Weekly</option>
 <option value="4">Semi-Monthly</option>
 <option value="5">Monthly</option>
 <option value="6">Quarterly</option>
 <option value="7">Annually</option>
 </select>

<p>&nbsp;</p>

<label for="cweekHours">Enter Hours per workweek</label> 
<input type="number" step="any" id="cweekHours" name="cweekHours" min="0" value="40" onChange="cwage_salary_calc();" />

<p>&nbsp;</p>

<label for="cdaysHours">Enter Days per workweek</label> 
<input type="number" step="any" id="cweekDays" name="cweekDays" min="0" value="5" onChange="cwage_salary_calc();" />

<tr id="ln3">
<td colspan="2">
<p>&nbsp;</p>
<input type="button" value="Calculate" onclick="cwage_salary_calc();" />&nbsp;
<input type="button" value="Reset" onclick="cEmptyAllVal();" />
</td>
</tr>

</td>
</tr>

<tr><td>&nbsp;</td></tr>


		<tr id="lnk" style="background:#e4e4e4;">
			<th style="text-align:left;padding:3px 5px 4px 6px;background:#e4e4e4;">Period</th>
			<th colspan="2"  style="text-align:left;padding:3px 5px 4px 6px;background:#e4e4e4;">Result</th>
		</tr>

		<tr id="ln1" class="odd" style="background:#ffffff">
			<td width="50%" style="text-align:left;">Annually</td>
			 <td width="50%" style="text-align:left;"><span id="cres1"></span></td>
		</tr>
		<tr id="ln2" style="background:#ffffff">
			<td width="50%" style="text-align:left;">Quarterly</td>
			 <td width="50%" style="text-align:left;"><span id="cres2"></span></td>
		</tr>
		<tr id="ln4" class="odd" style="background:#ffffff">
			<td width="50%" style="text-align:left;">Monthly</td>
			<td width="50%" style="text-align:left;"><span id="cres3"></span></td>
		</tr>
		<tr id="ln6" style="background:#ffffff">
			<td width="50%" style="text-align:left;">Semi-Monthly</td>
			 <td width="50%" style="text-align:left;"><span id="cres4"></span></td>
		</tr>
		<tr id="ln7" class="odd" style="background:#ffffff">
			<td width="50%" style="text-align:left;">Bi-Weekly</td>
			 <td  width="50%"style="text-align:left;"><span id="cres5"></span></td>
		</tr>
		<tr id="ln8" style="background:#ffffff">
			<td width="50%" style="text-align:left;">Weekly</td>
			<td width="50%" style="text-align:left;"><span id="cres6"></span></td>
		</tr>
		<tr id="ln9" class="odd" style="background:#ffffff">
			<td width="50%" style="text-align:left;">Daily</td>
			 <td width="50%" style="text-align:left;"><span id="cres8"></span></td>
		</tr>
		<tr id="ln10" style="background:#ffffff">
			<td width="50%" style="text-align:left;padding-bottom:5px;">Hourly</td>
			 <td width="50%" style="text-align:left;padding-bottom:5px;"><span id="cres7"></span></td>
		</tr>	

</table>

			<script type="text/javascript">
			jQuery(document).ready(function($) {cwage_salary_calc();});	
			</script>

		</div>';
    	$output[] = $after_widget;
    	return join($output, "\n");
    }

	function calc_control() {
		$class_name = 'goodcalculators_wage_calculator';
		$calc_title = 'Wage Conversion Calculator';

	    $options = get_option($class_name);

		if (!is_array($options)) $options = array('title'=>$calc_title);

		if ($_POST[$class_name.'_submit']) {
			$options['title'] = strip_tags(stripslashes($_POST[$class_name.'_title']));
			update_option($class_name, $options);
		}

		$title = htmlspecialchars($options['title'], ENT_QUOTES);

		echo '<p>Title: <input style="width: 240px;" name="'.$class_name.'_title" type="text" value="'.$title.'" /></p>';
		echo '<input type="hidden" name="'.$class_name.'_submit" value="1" />';
	}

    function calc_shortcode($args, $content=null) {
        return goodcalculators_wage_calculator::calc_display(false, $args);
    }

    function calc_widget($args) {
        echo goodcalculators_wage_calculator::calc_display(true, $args);
    }
}

add_action('widgets_init', array('goodcalculators_wage_calculator', 'calc_init'));

?>