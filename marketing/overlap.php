<div class="page-header js-affix">
    <h3><?=end($naviMenu->location); ?> (중복상품리스트)</h3>
    <div class="btn-group">
        <input type="button" value="노출상품 현황 확인" class="btn btn-white js-layer-naver-stats"/>
        <input type="button" value="저장" class="btn btn-red" id="batchSubmit"/>
    </div>
</div>

	<div class="notice-danger">
     	<b>중복상품리스트</b>은 입력한 검색 값이 적용되지 않습니다.
	</div>


<form>
	<input type="hidden" name="mode" value="overlap">
    <div class="table-header">
        <div class="pull-left">
            검색[그룹<strong><?=number_format($page->recode['count']);?></strong>개 <!-- , 상품 <strong><?=number_format($page->recode['totalsum']);?></strong>개  -->] /
            전체[그룹<strong><?=number_format($page->recode['amount']);?></strong>개, 상품<strong><?=number_format($page->recode['sum']);?></strong>개]
        </div>
        <div class="pull-right form-inline">
            <?=gd_select_box('pageNum', 'pageNum', gd_array_change_key_value([10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 200, 300, 500, 1000]), '개 보기', Request::get()->get('pageNum'), null, 'onchange="this.form.submit();"'); ?>
        </div>
    </div>
</form>

<form id="frmBatchNaver" name="frmBatchNaver" action="../goods/goods_ps.php"    target="ifrmProcess" method="post">
    <input type="hidden" name="mode" value="batch_naver_config" />
    <div class="table-action" style="margin:0;">
        <div class="pull-left">
            <button type="button" class="btn btn-black js-check-sale">상품 노출/판매 수정</button>
            <button type="button" class="btn btn-white js-check-soldout">상품 품절처리</button>
            <button type="button" class="btn btn-white js-check-copy">선택 복사</button>
            <button type="button" class="btn btn-white js-check-delete">선택 삭제</button>
        </div>
    </div>

    <?php
    foreach ($batchAll as $key => $val) {
        echo '<input type="hidden" name="queryAll['.$key.']" value="'.$val.'" />'.chr(10);
    }
    ?>
    <div class="table-responsive">
        <table class="table table-rows table-fixed">
            <thead>
            <tr>
                <th class="width5p center" rowspan="2"><input type="checkbox" class="js-checkall" data-target-name="arrGoodsNo[]"></th>
                <th class="width5p center" rowspan="2">번호</th>
                <th class="width-2xs" rowspan="2">상품코드<br>이미지</th>
                <th class="center" rowspan="2">상품명</th>
                <th class="width-3xs center" rowspan="2">네이버<br/>노출여부</th>
                <!-- <th class="width-xs center" rowspan="2">공급사</th> -->
                <th class="width-xs center" colspan="2">노출상태</th>
                <th class="width-xs center" colspan="2">판매상태</th>
                <th class="width-3xs  center" rowspan="2">품절여부</th>
                <th class="width5p  center" rowspan="2">재고</th>
                <th class="width-xs center" rowspan="2">판매가</th>
                <th class="width-xs center" rowspan="2">등록일<br>(수정일)</th>
            </tr>
            <tr>
                <th class="width-4xs center">PC</th>
                <th class="width-4xs center">모바일</th>
                <th class="width-4xs center">PC</th>
                <th class="width-4xs center">모바일</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (gd_isset($data) && count($data) > 0 ) {
                $arrGoodsDisplay = ['y' => '노출', 'n' => '<b style=\'color: #fa2828\'>비노출</b>'];
                $arrGoodsSell = ['y' => '판매', 'n' => '<b style=\'color: #fa2828\'>비판매</b>'];
                $gIdx = "";
                foreach ($data as $key => $val) {

                    list($totalStock,$stockText) = gd_is_goods_state($val['stockFl'],$val['totalStock'],$val['soldOutFl']);

                    ?>
                    <tr <?=$val['gIdx'] == $gIdx ? "": "style='background: #f5f9fc' " ?>>
                        <td class="center number">
                            <input type="checkbox" name="arrGoodsNo[]" value="<?=$val['goodsNo']; ?>" <?=$val['gIdx'] == $gIdx ? "checked='checked'":""?> />
                            <input type="checkbox" name="goodsNo[<?=$val['goodsNo']; ?>]" value="<?=$val['goodsNo']; ?>" style="display: none;" />
                        </td>
                        <td class="center"><?=$val['gIdx'] == $gIdx ? "": number_format($page->idx--) ?></td>
                        <td class="center">
                            <?=gd_html_goods_image($val['goodsNo'], $val['imageName'], $val['imagePath'], $val['imageStorage'], 40, $val['goodsNm'], '_blank'); ?>
                        </td>
                        <td>
							[<?=$val['goodsNo']; ?>]                        
                            <div><a href="../goods/goods_register.php?goodsNo=<?=$val['goodsNo']; ?>" target="_blank"><span style="color:<?=$val['gIdx'] == $gIdx ? "gray":""?>;"  class="emphasis_text"><?=$val['goodsNm']; ?></span></a></div>
                        </td>
                        <td class="center"><?=$arrGoodsDisplay[$val['naverFl']]; ?></td>
                        <!-- <td class="center"><?= $val['scmNm'] ?></td> -->
                        <td class="center"><?=$arrGoodsDisplay[$val['goodsDisplayFl']]; ?></td>
                        <td class="center"><?=$arrGoodsDisplay[$val['goodsDisplayMobileFl']]; ?></td>
                        <td class="center"><?=$arrGoodsSell[$val['goodsSellFl']]; ?></td>
                        <td class="center"><?=$arrGoodsSell[$val['goodsSellMobileFl']]; ?></td>
                        <td class="center"><?=$stockText == "품절" ? "<b style='color: #fa2828'>품절</b>":$stockText ?></td>
                        <td class="center"><?=$totalStock?></td>
                        <td class="center number">
                            <div class="form-inline"><?=gd_currency_symbol(); ?><?=gd_money_format($val['goodsPrice']); ?><?=gd_currency_string(); ?></div>
                        </td>
                        <td class="center date">
                            <b><?=$val['regDt'] ?></b>
                            <?php if ($val['modDt']) { echo "<br/>(" . $val['modDt'] . ")";} ?>
                    	</td>
                    </tr>
                    <?php
                    
                    $gIdx = $val['gIdx'];
                }
            }  else {

                ?>
                <tr><td class="no-data" colspan="10">검색된 정보가 없습니다.</td></tr>
            <?php } ?>
            </tbody>
        </table>
        
	<div class="table-action" style="margin:0;">
        <div class="pull-left">
            <button type="button" class="btn btn-black js-check-sale">상품 노출/판매 수정</button>
            <button type="button" class="btn btn-white js-check-soldout">상품 품절처리</button>
            <button type="button" class="btn btn-white js-check-copy">선택 복사</button>
            <button type="button" class="btn btn-white js-check-delete">선택 삭제</button>
        </div>
    </div>
        
        
    </div>
    <div class="center"><?=$page->getPage();?></div>
    <div class="mgt10"></div>
    <!-- 
    <div>
        <label class="checkbox-inline"><input type="checkbox" id="batchAll" name="batchAll" value="y" />검색된 상품 전체(<?=number_format($page->recode['total']);?>개 상품)를 수정합니다.</label>
        <p class="notice-danger mgt5">상품수가 많은 경우 비권장합니다. 가능하면 한 페이지씩 선택하여 수정하세요.</p>
    </div>
     -->
    <div>
        <table class="table table-cols" id="setNaverConfig">
            <colgroup><col class="width-md" /><col /></colgroup>
            <tr>
                <th class="center">
                    네이버 쇼핑 노출설정
                </th>
                <td>
                    <label class="radio-inline"><input type="radio" name="naverFl" value="y"  checked />노출함</label>
                    <label class="radio-inline"><input type="radio" name="naverFl" value="n" />노출안함</label>
                </td>
            </tr>
        </table>
    </div>
</form>

<script type="text/javascript">

    $(document).ready(function(){

        $(".js-layer-naver-stats").click(function(e){
            layer_add_info('naver_stats');
        });

        $( "#batchSubmit" ).click(function() {

            var msg = '';
                    
            if ($('#batchAll:checked').length == 0 || true) {
                if ($('input[name="arrGoodsNo[]"]:checked').length == 0) {
                    $.warnUI('항목 체크', '선택된 항목이 없습니다.');
                    return false;
                }

                msg += '선택된 상품의 ';
            } else {
                msg += '검색된 전체 상품의 ';
            }

            msg += '네이버 쇼핑 노출 상태를 '+$('#setNaverConfig input[name="naverFl"]:checked').closest('label').text()+ '으 로 \n';

            msg += '일괄 수정하시겠습니까?\n\n';
            msg += '[주의] 일괄적용 후에는 이전상태로 복원이 안되므로 신중하게 변경하시기 바랍니다.';

            dialog_confirm(msg, function (result) {
                if (result) {
                	$('#frmBatchNaver input[name=\'mode\']').val('batch_naver_config');
                	$('#frmBatchNaver').attr('method', 'post');
                	$('#frmList').attr('action', '../goods/goods_ps.php');
                    $("#frmBatchNaver").submit();
                }
            });
        });




        // 삭제
        $('button.js-check-delete').click(function () {
        	setGoodsCheck();
            var chkCnt = $('input[name*="goodsNo"]:checked').length;

            if (chkCnt == 0) {
                alert('선택된 상품이 없습니다.');
                return;
            }

            dialog_confirm('선택한 ' + chkCnt + '개 상품을  정말로 삭제하시겠습니까?\n삭제 된 상품은 [삭제상품 리스트]에서 확인 가능합니다.', function (result) {
                if (result) {
                	$('#frmBatchNaver input[name=\'mode\']').val('delete_state');
                	$('#frmBatchNaver').attr('method', 'post');
                	$('#frmList').attr('action', '../goods/goods_ps.php');
                    $("#frmBatchNaver").submit();
                }
            });

        });

        // 복사
        $('button.js-check-copy').click(function () {
        	setGoodsCheck();
            var chkCnt = $('input[name*="goodsNo"]:checked').length;
            if (chkCnt == 0) {
                alert('선택된 상품이 없습니다.');
                return;
            }

            dialog_confirm('선택한 ' + chkCnt + '개 상품을  정말로 복사하시겠습니까?', function (result) {
                if (result) {
                	$('#frmBatchNaver input[name=\'mode\']').val('copy');
                	$('#frmBatchNaver').attr('method', 'post');
                	$('#frmList').attr('action', '../goods/goods_ps.php');
                    $("#frmBatchNaver").submit();
                }
            });

        });

        // 품절
        $('button.js-check-soldout').click(function () {
        	setGoodsCheck();
            var chkCnt = $('input[name*="goodsNo"]:checked').length;
            if (chkCnt == 0) {
                alert('선택된 상품이 없습니다.');
                return;
            }

            dialog_confirm('선택한 ' + chkCnt + '개 상품을 품절처리 하시겠습니까?', function (result) {
                if (result) {
                	$('#frmBatchNaver input[name=\'mode\']').val('soldout');
                	$('#frmBatchNaver').attr('method', 'post');
                	$('#frmList').attr('action', '../goods/goods_ps.php');
                    $("#frmBatchNaver").submit();
                }
            });

        });

        // 노출 설정
        $('button.js-check-sale').click(function () {
        	setGoodsCheck();
            var chkCnt = $('input[name*="goodsNo"]:checked').length;

            if (chkCnt == 0) {
                alert('선택된 상품이 없습니다.');
                return;
            }

            var childNm = 'goods_sale';
            var addParam = {
                mode: 'simple',
                layerTitle: '노출 및 판매상태 설정',
                layerFormID: childNm + "Layer",
                parentFormID: childNm + "Row",
                dataFormID: childNm + "Id",
                dataInputNm: childNm
            };
            layer_add_info(childNm, addParam);
        });


        
        $('select[name=\'pageNum\']').change(function () {
            $('#frmSearchGoods').submit();
        });

        $('select[name=\'sort\']').change(function () {
            $('#frmSearchGoods').submit();
        });


    });


    /**
     *  체크 박스 동기화
     */
    function setGoodsCheck(){

    	// 모든 체크 해제
    	$('input[name*="goodsNo"]').prop('checked', false);
    	$('input[name="arrGoodsNo[]"]:checked').each(function (i) {
    		$('input[name*="goodsNo"]:input[value='+$(this).val()+']').prop('checked', true);
			console.log($(this).val());
    	 });

    	
    }

    /**
     * 카테고리 연결하기 Ajax layer
     */
    function layer_register(typeStr, mode, isDisabled) {

        var addParam = {
            "mode": mode
        };

        // 레이어 창

        if (typeStr == 'scm') {
            addParam['mode'] = 'radio';
            $('input:radio[name=scmFl]:input[value=y]').prop("checked", true);
        }

        if (typeStr == 'delivery') {
            addParam['dataInputNm']		= 'deliverySno';
            var scmFl = $('input[name="scmFl"]:checked').val();
            if(scmFl !='all')
            {
                addParam['scmFl'] =scmFl;

                if($('input[name="scmNo[]"]').val()) addParam['scmNo'] =$('input[name="scmNo[]"]').val();
                else addParam['scmNo'] = $('input[name="scmNo"]').val();
            }

        }

        if (!_.isUndefined(isDisabled) && isDisabled == true) {
            addParam.disabled = 'disabled';
        }

        layer_add_info(typeStr,addParam);
    }
</script>
