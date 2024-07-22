<?php exit;include_once '../inc/connection.php';
      include_once '../inc/functions.php';
      $selectdepartment = mysqli_query($link,"select * from department");
      while($rwselectdepartment = mysqli_fetch_array($selectdepartment)){
            $d_id = $rwselectdepartment['d_id'];
            $d_sitename = $rwselectdepartment['d_sitename'];
            for($i=1;$i<=12;$i++){
                if($i=="1"){
                    $i="01";
                }else if($i=="02"){
                    $i="02";
                }else if($i=="03"){
                    $i="03";
                }else if($i=="04"){
                    $i="04";
                }else if($i=="05"){
                    $i="05";
                }else if($i=="06"){
                    $i="06";
                }else if($i=="07"){
                    $i="07";
                }else if($i=="08"){
                    $i="08";
                }else if($i=="09"){
                    $i="09";
                }else{
                    $i=$i;
                }
                for($j=2020;$j<=date('Y');$j++){
                    $selectemployee = mysqli_query($link,"select e.*,ea.* from employee as e, employee_attendance as ea where e.e_id=ea.ea_emp_id and ea.ea_emp_status='0' and ea.ea_emp_date LIKE '%".$j."-".$i."%' and e.e_depart_id='".$d_id."' GROUP BY ea.ea_emp_id");
                    $selectemployee2 = mysqli_query($link,"select e.*,ea.* from employee as e, employee_attendance as ea where e.e_id=ea.ea_emp_id and ea.ea_emp_status='0' and ea.ea_emp_date LIKE '%".$j."-".$i."%' and e.e_depart_id='".$d_id."' GROUP BY ea.ea_emp_id");
                    if(mysqli_num_rows($selectemployee)>0){
                        $cmp_id = "";
                        while($rwselectemployee = mysqli_fetch_array($selectemployee)){
                            $emp_id = $rwselectemployee['e_id'];
                            $cmp_id = $rwselectemployee['e_company_id'];
                        }
                        
                        $selectincrement = mysqli_query($link,"select * from invoice where inv_com_id='".$cmp_id."'");
        		        $nmselectincrement = mysqli_num_rows($selectincrement);
        		        if($nmselectincrement > 0){
        		            $nmselectincrement = $nmselectincrement + 1;
        		        }else{
        		            $nmselectincrement = 1;
        		        }
                        
                        $inv_to = get_department($d_id)." ".get_department_city($d_id);
                        $inv_to_add = get_department_village($d_id)." ".get_department_city($d_id)." ".get_department_state($d_id);
                        $inv_gst_per = "18";
                        $inv_service_charge = "5";
                        
                        $update_qry = "INSERT INTO `invoice`(`inc_icre_id`, `inv_com_id`, `inv_to`, `inv_to_add`, `inv_to_city`, `inv_date`, `inv_subject`, `inv_gst_per`, `inv_note`,`inv_service_charge`) VALUES ('".$nmselectincrement."','".$cmp_id."','".$inv_to."','".$inv_to_add."','".get_department_city($d_id)."','".date('Y-m-d')."','".$d_sitename."','".$inv_gst_per."','','')";  
          		        mysqli_query($link,$update_qry); 
          		        $lastid = mysqli_insert_id($link);
          		        
          		        $totDays = get_days_in_month($i, $j);
          		        $ttotalchargev = 0;
          		        while($rwselectemployee2 = mysqli_fetch_array($selectemployee2)){
                            $emp_id2 = $rwselectemployee2['e_id'];
                            $cmp_id2 = $rwselectemployee2['e_company_id'];
                            
                            $selecemployeedata = mysqli_query($link,"select * from employee where e_id='".$emp_id2."'");
          		            $rwselecemployeedata = mysqli_fetch_array($selecemployeedata);
          		            
                            $totalpresntscount = 0;
			                $totalabpresntscount = 0;
                            $totalableavescount = 0;
                            for($k=1;$k<=31;$k++){
                                if($k==1){
                                    $day = "01";
                                }else if($k==2){
                                    $day = "02";
                                }else if($k==3){
                                    $day = "03";
                                }else if($k==4){
                                    $day = "04";
                                }else if($k==5){
                                    $day = "05";
                                }else if($k==6){
                                    $day = "06";
                                }else if($k==7){
                                    $day = "07";
                                }else if($k==8){
                                    $day = "08";
                                }else if($k==9){
                                    $day = "09";
                                }else{
                                    $day = $k;
                                }
                                
                                $selectattendence2 = mysqli_query($link,"select * from employee_attendance where ea_emp_id='".$emp_id2."' and ea_emp_date='".$j."-".$i."-".$day."'");
                                if(mysqli_num_rows($selectattendence2)>0){
                                      $rwselectattendence = mysqli_fetch_array($selectattendence2);
                                      if($rwselectattendence['ea_emp_attendance_type'] == "1"){
                                          
                                          $totalpresntscount = $totalpresntscount + 1;
                                      }
                    
                                      if($rwselectattendence['ea_emp_attendance_type'] == "2"){
                                          $totalabpresntscount = $totalabpresntscount + 1;
                                      }
                    
                                      if($rwselectattendence['ea_emp_attendance_type'] == "0"){
                                          $totalableavescount = $totalableavescount + 1;
                                      }
                    
                                }
                                $totalpcount = $totalpresntscount+$totalabpresntscount;
                                mysqli_query($link,"update employee_attendance set ea_emp_status='1' where ea_emp_id='".$emp_id2."' and ea_emp_date='".$j."-".$i."-".$day."'");
                            }
                            
                            if($rwselecemployeedata['e_wedge'] != ""){
                                  $ewages = $rwselecemployeedata['e_wedge'];
                                  $finalwages = $rwselecemployeedata['e_wedge'] * $totDays;
                            }else if($rwselecemployeedata['e_fullwedge'] != ""){
                                  $ewages = $rwselecemployeedata['e_fullwedge'] / $totDays;
                                  $finalwages = $rwselecemployeedata['e_fullwedge'];
                            }else{
                                  $ewages = 0;
                                  $finalwages = 0;
                            }
                            
                            if($rwselecemployeedata['e_da'] != ""){
                                  $e_da = $rwselecemployeedata['e_da'];
                            }else{
                                  $e_da = 0;
                            }
                              
                            if($rwselecemployeedata['e_actual_hra'] != ""){
                                  $e_actual_hra = $rwselecemployeedata['e_actual_hra'];
                            }else{
                                  $e_actual_hra = 0;
                            }
                              
                            if($rwselecemployeedata['e_medical_allow'] != ""){
                                  $e_medical_allow = $rwselecemployeedata['e_medical_allow'];
                            }else{
                                  $e_medical_allow = 0;
                            }
                              
                            if($rwselecemployeedata['e_convey_allow'] != ""){
                                  $e_convey_allow = $rwselecemployeedata['e_convey_allow'];
                            }else{
                                  $e_convey_allow = 0;
                            }
                              
                            if($rwselecemployeedata['e_edu_allow'] != ""){
                                  $e_edu_allow = $rwselecemployeedata['e_edu_allow'];
                            }else{
                                  $e_edu_allow = 0;
                            }
                              
                              
                            if($rwselecemployeedata['e_other_allow'] != ""){
                                  $e_other_allow = $rwselecemployeedata['e_other_allow'];
                            }else{
                                  $e_other_allow = 0;
                            }
                              
                              
                            if($rwselecemployeedata['e_earning_hra'] != ""){
                                  $e_earning_hra = $rwselecemployeedata['e_earning_hra'];
                            }else{
                                  $e_earning_hra = 0;
                            }
                              
                            if($rwselecemployeedata['e_earning_medical'] != ""){
                                  $e_earning_medical = $rwselecemployeedata['e_earning_medical'];
                            }else{
                                  $e_earning_medical = 0;
                            }
                              
                            if($rwselecemployeedata['e_earning_conveyance'] != ""){
                                  $e_earning_conveyance = $rwselecemployeedata['e_earning_conveyance'];
                            }else{
                                  $e_earning_conveyance = 0;
                            }
                              
                            if($rwselecemployeedata['e_earning_sta_bonus'] != ""){
                                  $e_earning_sta_bonus = $rwselecemployeedata['e_earning_sta_bonus'];
                            }else{
                                  $e_earning_sta_bonus = 0;
                            }
                              
                            if($rwselecemployeedata['e_earning_leave_enc'] != ""){
                                  $e_earning_leave_enc = $rwselecemployeedata['e_earning_leave_enc'];
                            }else{
                                  $e_earning_leave_enc = 0;
                            }
                              
                            if($rwselecemployeedata['e_earning_gratuity'] != ""){
                                  $e_earning_gratuity = $rwselecemployeedata['e_earning_gratuity'];
                            }else{
                                  $e_earning_gratuity = 0;
                            }
                              
                            if($rwselecemployeedata['e_earning_spe_a'] != ""){
                                  $e_earning_spe_a = $rwselecemployeedata['e_earning_spe_a'];
                            }else{
                                  $e_earning_spe_a = 0;
                            }
                              
                            if($rwselecemployeedata['e_earning_pro_inc_attn_bonus'] != ""){
                                  $e_earning_pro_inc_attn_bonus = $rwselecemployeedata['e_earning_pro_inc_attn_bonus'];
                            }else{
                                  $e_earning_pro_inc_attn_bonus = 0;
                            }
                              
                            if($rwselecemployeedata['e_earning_ot_amount'] != ""){
                                  $e_earning_ot_amount = $rwselecemployeedata['e_earning_ot_amount'];
                            }else{
                                  $e_earning_ot_amount = 0;
                            }
                              
                            if($rwselecemployeedata['e_pt'] != ""){
                                  $e_pt = $rwselecemployeedata['e_pt'];
                            }else{
                                  $e_pt = 0;
                            }
                              
                            if($rwselecemployeedata['e_pf'] != ""){
                                  $e_pf = $rwselecemployeedata['e_pf'];
                            }else{
                                  $e_pf = 0;
                            }
                              
                            if($rwselecemployeedata['e_esi'] != ""){
                                  $e_esi = $rwselecemployeedata['e_esi'];
                            }else{
                                  $e_esi = 0;
                            }
                              
                            if($rwselecemployeedata['e_lwf'] != ""){
                                  $e_lwf = $rwselecemployeedata['e_lwf'];
                            }else{
                                  $e_lwf = 0;
                            }
                              
                            if($rwselecemployeedata['e_tds'] != ""){
                                  $e_tds = $rwselecemployeedata['e_tds'];
                            }else{
                                  $e_tds = 0;
                            }
                              
                            if($rwselecemployeedata['e_advance'] != ""){
                                  $e_advance = $rwselecemployeedata['e_advance'];
                            }else{
                                  $e_advance = 0;
                            }
                              
                            if($rwselecemployeedata['e_loan_ins'] != ""){
                                  $e_loan_ins = $rwselecemployeedata['e_loan_ins'];
                            }else{
                                  $e_loan_ins = 0;
                            }
                              
                            if($rwselecemployeedata['e_canteen'] != ""){
                                  $e_canteen = $rwselecemployeedata['e_canteen'];
                            }else{
                                  $e_canteen = 0;
                            }
                              
                            if($rwselecemployeedata['e_oth_ded'] != ""){
                                  $e_oth_ded = $rwselecemployeedata['e_oth_ded'];
                            }else{
                                  $e_oth_ded = 0;
                            }
                              
                            if($rwselecemployeedata['e_facility_time_safety_exp'] != ""){
                                  $e_facility_time_safety_exp = $rwselecemployeedata['e_facility_time_safety_exp'];
                            }else{
                                  $e_facility_time_safety_exp = 0;
                            }
                              
                            if($rwselecemployeedata['e_epf'] != ""){
                                  $e_epf = $rwselecemployeedata['e_epf'];
                            }else{
                                  $e_epf = 0;
                            }
                              
                            if($rwselecemployeedata['e_fpf'] != ""){
                                  $e_fpf = $rwselecemployeedata['e_fpf'];
                            }else{
                                  $e_fpf = 0;
                            }
                              
                            if($rwselecemployeedata['e_emp_contribution'] != ""){
                                  $e_emp_contribution = $rwselecemployeedata['e_emp_contribution'];
                            }else{
                                  $e_emp_contribution = 0;
                            }
                              
                            if($rwselecemployeedata['e_abry_pf'] != ""){
                                  $e_abry_pf = $rwselecemployeedata['e_abry_pf'];
                            }else{
                                  $e_abry_pf = 0;
                            }
                              
                            if($rwselecemployeedata['e_timeloss'] != ""){
                                  $e_timeloss = $rwselecemployeedata['e_timeloss'];
                            }else{
                                  $e_timeloss = 0;
                            }
                              
                            if($rwselecemployeedata['e_admin_wedge'] != ""){
                                  $e_admin_wedge = $rwselecemployeedata['e_admin_wedge'];
                            }else{
                                  $e_admin_wedge = 0;
                            }
                              
                            if($rwselecemployeedata['e_bonus_wedge'] != ""){
                                  $e_bonus_wedge = $rwselecemployeedata['e_bonus_wedge'];
                            }else{
                                  $e_bonus_wedge = 0;
                            }
                              
                            if($rwselecemployeedata['e_travel_wedge'] != ""){
                                  $e_travel_wedge = $rwselecemployeedata['e_travel_wedge'];
                            }else{
                                  $e_travel_wedge = 0;
                            }
                              
                            if($rwselecemployeedata['e_other_wedge'] != ""){
                                  $e_other_wedge = $rwselecemployeedata['e_other_wedge'];
                            }else{
                                  $e_other_wedge = 0;
                            }
                              
                            if($rwselecemployeedata['e_insurance'] != ""){
                                  $e_insurance = $rwselecemployeedata['e_insurance'];
                            }else{
                                  $e_insurance = 0;
                            }
                              
                            if($rwselecemployeedata['e_incometax'] != ""){
                                  $e_incometax = $rwselecemployeedata['e_incometax'];
                            }else{
                                  $e_incometax = 0;
                            }
                              
                            if($rwselecemployeedata['e_epfo'] != ""){
                                  $e_epfo = $rwselecemployeedata['e_epfo'];
                            }else{
                                  $e_epfo = 0;
                            }
                              
                            if($rwselecemployeedata['e_admin_epfo'] != ""){
                                  $e_admin_epfo = $rwselecemployeedata['e_admin_epfo'];
                            }else{
                                  $e_admin_epfo = 0;
                            }
                              
                            if($rwselecemployeedata['e_admin_esic'] != ""){
                                  $e_admin_esic = $rwselecemployeedata['e_admin_esic'];
                            }else{
                                  $e_admin_esic = 0;
                            }
                            
                            $totalwages = $totalpcount * $ewages;
                            $totalwatan = $totalwages/$totalpcount*$totalpcount;
                            $totalesic = round(($totalwages * $e_esi) / 100);
                            $totalpf = $e_pf;
                            $totaltxt_vat = $totalpf + $totalesic + $e_pt;
                            $netpayment = $totalwatan - $totaltxt_vat;
                            $totaldays = $totaldays + $totalpcount;
                            $totalwatanval = $totalwatanval + $totalwatan;
                            $totalpfval = $totalpfval + $totalpf;
                            $totalesicval = $totalesicval + $totalesic;
                            $totalptval = $totalptval + $e_pt;
                            $totalvatamtxtval = $totalvatamtxtval + $totaltxt_vat;
                            $totalnetpaymentval = $totalnetpaymentval + $netpayment;
                            $totalholiday = 7;
                            $totalworkingdays = $totDays - $totalableavescount - $totalholiday;
                            $fl_totalworkingdays = $fl_totalworkingdays + $totalworkingdays;
                            $totalpresentcountdata = $totDays - $totalableavescount;
                            $fl_totalpresentcountdata = $fl_totalpresentcountdata + $totalpresentcountdata;
                            $totalbasic = $finalwages / $totDays * $totalpresentcountdata;
                            $fl_totalbasic = $fl_totalbasic + $totalbasic;
                            $epfo = $e_epfo;
                            $fl_totalepfo = $fl_totalepfo + $epfo;
                            $fesic = round(($totalwages * $e_esi) / 100);
                            $fl_fesic = $fl_fesic + $fesic;
                            $aepfo = $e_admin_epfo;
                            $fl_aepfo = $fl_aepfo + $aepfo;
                            $aesic = $e_admin_esic;
                            $fl_aesic = $fl_aesic + $aesic;
                            $bonus = $e_bonus_wedge;
                            $fl_bonus = $fl_bonus + $bonus;
                            $totalofctc = $totalbasic + $epfo + $fesic + $aepfo + $aesic + $bonus;
                            $fl_totalofctc = $fl_totalofctc + $totalofctc;
                            $servicecharge = $totalofctc * $service_charge / 100;
                            $fl_servicecharge = $fl_servicecharge + $servicecharge;
                            $totalcharge = $totalofctc + $servicecharge;
                            $fl_totalcharge = $fl_totalcharge + $totalcharge;
                            $fsgst = $totalofctc * $sgst / 100;
                            $fl_fsgst = $fl_fsgst + $fsgst;
                            $fcgst = $totalofctc * $cgst / 100;
                            $fl_fcgst = $fl_fcgst + $fcgst;
                            $netbilling = $totalcharge + $fsgst + $fcgst;
                            $fl_netbilling = $fl_netbilling + $netbilling;
                            
                            $item_name = 'Manpower Outsourcing Services - '.get_employeedeignation($emp_id2).' ('.get_month2($i).' '.$j.')';
                            $item_qty = '1';
                            $item_rate = number_format((float)$totalofctc, 2, '.', '');
                            
                            $update_qry2 = "INSERT INTO `invoice_data`(`inv_d_m_id`, `inv_d_item`, `inv_d_qty`, `inv_d_rate`) VALUES ('".$lastid."','".$item_name."','".$item_qty."','".$item_rate."')";  
                            mysqli_query($link,$update_qry2);
                              
                            $ttotalchargev = $ttotalchargev + ($item_qty * $item_rate);
                            
                            
                            
                        }
          		
          		        $finalcgst = ($ttotalchargev * 9) / 100;
          		        $finalsgst = ($ttotalchargev * 9) / 100;
          		        $finalchanger = (($ttotalchargev + $finalcgst + $finalsgst) * $inv_service_charge) / 100;
          		        mysqli_query($link,"update invoice set inv_service_charge='".$finalchanger."' where inv_id='".$lastid."'");
                    }
                }
            }
            
      }
?>