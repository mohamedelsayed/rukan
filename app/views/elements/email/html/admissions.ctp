<html>
	<head></head>
	<body>
		<style type="text/css">
		table.odd_even_table tr:nth-child(even) td{
            background-color: #eaeaea
        }
        table.odd_even_table tr:nth-child(odd) td{
            background-color: #f2f2f2
        }
		.element{
			font-size:16px;		
			color: #000000;
			font-family: Verdana, Arial, Helvetica, sans-serif; 		
		}
		.title{
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size:16px;
			color:#FFFFFF;
		}
		.maintable{
			border-bottom-color:#384270;
			border-left-color: #384270;
			border-right-color:#384270;
			border-top-color:#384270;
			width: 100%;
		}
		.td_left{
		    text-align: left;		    			    
		}
		.head{
		    background-color: #0d9f49 !important;	    
		}
		.title_td{
		    text-align: center;
		}
		table{
		    width: 100%;			    
		}
		.td_center{
            text-align: center;
        }            
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        table, td {
            border: 1px solid #dddddd;
        }
        table.admissions tr:nth-child(2n) td{
            background-color: #eaeaea !important;
        }
        table.admissions tr td{
            border-bottom: 5px solid #ffffff;
            border-right: 5px solid #ffffff;
            color: #414141;
            font-size: 17px;
            padding: 1% 0;
            text-align: center;
            text-decoration: none;
        }
        table tr td.is_head {
            background-color: #0d9f49 !important;
            border-bottom: 5px solid #ffffff;
            border-right: 5px solid #ffffff;
            color: #ffffff;
            padding: 1px 0;
            text-decoration: none;
        }
        .head_div_left{
            text-align: left;
            margin: 5px 0px;                 
        }
		</style>
		<table style="direction: ltr;" class="maintable" cellspacing='0' cellpadding='2'>
			<tr class="head">
				<td height='30' colspan='2' class="title_td">
					<font class="title">
						<strong><?php echo $subject;?></strong>
					</font>
				</td>
			</tr>
			<tr>
				<td colspan='2' align='center' height="30"></td>
			</tr>
			<?php if($html != ''){
			    echo $html;
            }?>
			<tr>
				<td colspan='2' height="30"></td>
			</tr>
			<tr class="head">
				<td height='30' colspan='2'></td>
			</tr>
		</table>
	</body>
</html>