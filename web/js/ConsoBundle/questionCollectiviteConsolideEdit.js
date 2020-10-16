/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



        function initForm() {

            var q1Res = $('input[name="qccForm[q1]"]').filter(':checked').val();
            if (q1Res == "1") {
                $('#qccForm_q2').show();
                $('#labelq2').show();
                $('#qccForm_q2_0').attr("required", "required");
                $('#qccForm_q2_1').attr("required", "required");
                
            } else {
                $('#qccForm_q2').hide();
                $('#labelq2').hide();
                $('#qccForm_q2_0').removeAttr("required");
                $('#qccForm_q2_1').removeAttr("required");
                
                $('#qccForm_q2_0').prop('checked',false);
                $('#qccForm_q2_1').prop('checked',false);
            }
            
            var q3Res = $('input[name="qccForm[q3]"]').filter(':checked').val();
            if (q3Res == "1") {
                $('#qccForm_q4').show();
                $('#labelq4').show();
                $('#qccForm_q4_0').attr("required", "required");
                $('#qccForm_q4_1').attr("required", "required");
            } else {
                $('#qccForm_q4').hide();
                $('#labelq4').hide();
                $('#qccForm_q4_0').removeAttr("required");
                $('#qccForm_q4_1').removeAttr("required");
                $('#qccForm_q4_0').removeAttr("checked");
                $('#qccForm_q4_1').removeAttr("checked");
                
                $('#qccForm_q4_0').prop('checked',false);
                $('#qccForm_q4_1').prop('checked',false);
            }
           
            var q5Res = $('input[name="qccForm[q5]"]').filter(':checked').val();
            if (q5Res == "1") {
                $('#qccForm_q6').show();
                $('#labelq6').show();
                $('#qccForm_q6_0').attr("required", "required");
                $('#qccForm_q6_1').attr("required", "required");
            } else {
                $('#qccForm_q6').hide();
                $('#labelq6').hide();
                $('#qccForm_q6_0').removeAttr("required");
                $('#qccForm_q6_1').removeAttr("required");
                $('#qccForm_q6_0').removeAttr("checked");
                $('#qccForm_q6_1').removeAttr("checked");
                
                $('#qccForm_q6_0').prop('checked',false);
                $('#qccForm_q6_1').prop('checked',false);
            }
           
            var q7Res = $('input[name="qccForm[q7]"]').filter(':checked').val();
            if (q7Res == "1") {
                $('#qccForm_q8').show();
                $('#labelq8').show();
                $('#qccForm_q8_0').attr("required", "required");
                $('#qccForm_q8_1').attr("required", "required");
            } else {
                $('#qccForm_q8').hide();
                $('#labelq8').hide();
                $('#qccForm_q8_0').removeAttr("required");
                $('#qccForm_q8_1').removeAttr("required");
                $('#qccForm_q8_0').removeAttr("checked");
                $('#qccForm_q8_1').removeAttr("checked");
                
                $('#qccForm_q8_0').prop('checked',false);
                $('#qccForm_q8_1').prop('checked',false);
            }
        }
        
        function isFalse()
        {
            var q1Res = $('input[name="qccForm[q1]"]').filter(':checked').val();
            var q3Res = $('input[name="qccForm[q3]"]').filter(':checked').val();
            var q5Res = $('input[name="qccForm[q5]"]').filter(':checked').val();
            var q7Res = $('input[name="qccForm[q7]"]').filter(':checked').val();
            var q9Res = $('input[name="qccForm[q9]"]').filter(':checked').val();
            var q10Res = $('input[name="qccForm[q10]"]').filter(':checked').val();
            var q11Res = $('input[name="qccForm[q11]"]').filter(':checked').val();
            var q12Res = $('input[name="qccForm[q12]"]').filter(':checked').val();
            var q13Res = $('input[name="qccForm[q13]"]').filter(':checked').val();
            var q14Res = $('input[name="qccForm[q14]"]').filter(':checked').val();

            if (q1Res == "1" || q3Res == "1" || q5Res == "1" || q7Res == "1" || q9Res == "1" || q10Res == "1" || q11Res == "1" || q12Res == "1" || q13Res == "1" || q14Res == "1") {
                return false;
            } else {
                return true;
            }
        }
        function checkWhoIsFalse(onChecked)
        {
            var array_to_check = {};
            
            array_to_check['q1'] =  $('input[name="qccForm[q1]"]').filter(':checked').val();
            array_to_check['q2'] =  $('input[name="qccForm[q2]"]').filter(':checked').val();
            array_to_check['q3'] =  $('input[name="qccForm[q3]"]').filter(':checked').val();
            array_to_check['q4'] =  $('input[name="qccForm[q4]"]').filter(':checked').val();
            array_to_check['q5'] =  $('input[name="qccForm[q5]"]').filter(':checked').val();
            array_to_check['q6'] =  $('input[name="qccForm[q6]"]').filter(':checked').val();
            array_to_check['q7'] =  $('input[name="qccForm[q7]"]').filter(':checked').val();
            array_to_check['q8'] =  $('input[name="qccForm[q8]"]').filter(':checked').val();
            array_to_check['q9'] =  $('input[name="qccForm[q9]"]').filter(':checked').val();
            array_to_check['q10'] = $('input[name="qccForm[q10]"]').filter(':checked').val();
            array_to_check['q11'] = $('input[name="qccForm[q11]"]').filter(':checked').val();
            array_to_check['q12'] = $('input[name="qccForm[q12]"]').filter(':checked').val();
            array_to_check['q13'] = $('input[name="qccForm[q13]"]').filter(':checked').val();
            array_to_check['q14'] = $('input[name="qccForm[q14]"]').filter(':checked').val();
            
            $.each(array_to_check,function(k,v){
                array_to_check[k] = isset(v) ? array_to_check[k] : false;
            });

            $.ajax({
                url: Routing.generate('check_before_remove_ind'),
                method: 'POST',
                data: {'arraytocheck': JSON.stringify(array_to_check)},
                async: true,
                success: function (response) {
                    var $tab = response;
                    var html = $('<div></div>');
                   
                    if(isEmpty(response['q1']) && isEmpty(response.q2) && isEmpty(response.q3) && isEmpty(response.q4) && isEmpty(response.q5) && isEmpty(response.q6) && isEmpty(response.q7) && isEmpty(response.q8) && isEmpty(response.q9) && isEmpty(response.q10) && isEmpty(response.q11) && isEmpty(response.q12) && isEmpty(response.q13) && isEmpty(response.q14)){
                        html = '';
                        onChecked(html);
                    }
                    $.each($tab, function (q_name, q_indis) {
                        if(!isEmpty(q_indis)){
                            var temp_msg = 'Le fait de répondre "Non" à la question ' + q_name + ' les données suivantes seront supprimées : <ul>';
                            var q_indis_tab = q_indis.split(';');
                            $.each(q_indis_tab, function (q_indi_key, q_indi_value) {
                                if(!isEmpty(q_indi_value)){
                                    temp_msg += "<li>"+q_indi_value+"</li>";
                                }
                            });
                            temp_msg += "</ul>";
                            html.append(createElement('div',temp_msg));
                        }
                    });
                    if(isCallable(onChecked)){
                        onChecked(html);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //                alert('SEARCH ERROR: ' + jqXHR + ' , ' + textStatus + ' , ' + errorThrown);
                }
            });
        }

        $(document).ready(function ()
        {
            initForm();
            $("#qccForm_q1").on("click", function () {
                initForm();
            });
            $("#qccForm_q3").on("click", function () {
                initForm();
            });
            $("#qccForm_q5").on("click", function () {
                initForm();
            });
            $("#qccForm_q7").on("click", function () {
                initForm();
            });

            $('.save').on('click', function(e) {
                var everyRadioAreNull = isFalse();
                if(everyRadioAreNull == true) {
                    e.preventDefault();
                    $('#isNull').modal('show');                    
                }else{
                    var form = $(this).parents('form:first');
                    e.preventDefault();
                    checkWhoIsFalse(function(ind_prevent){
                        if(!isEmpty(ind_prevent)){
                            destroyModal('#prevent');
                            var modal = createBtpModal('prevent', 'ATTENTION', ind_prevent,
                            {
                                buttons:[
                                    {
                                        lbl:sfTrans("modal.btn.oupsNon"),
                                        attr:{
                                            class:"btn btn-secondary"
                                        },
                                        extra:{
                                           dismiss:"modal" 
                                        },
                                    },{
                                        lbl:sfTrans("modal.btn.validerBilan"),
                                        attr:{
                                            class:"btn btn-primary"
                                        },
                                        callbacks:{
                                            click:function(){
                                                $(form).submit();
                                            }
                                        }
                                    }
                                ]
                            });
                            openBtpModal(modal);
                        }else{
                            $(form).submit();
                        }
                    });
                }
               
            });

//            $('.sendToZero').on('click', function() {
//                $.ajax({
//                    url: Routing.generate('set_conso_to_zero'),
//                    method: 'POST',
//                    success: function (response) {
//                        console.log("en cours");
//                    },
//                    complete: function(xhr)
//                    {
//                        if (xhr.status == 302) {
//                            location.href = xhr.getResponseHeader(Routing.generate('bilan_conso_edit'));
//                        }
//                    }
//                });
//            });

        });
