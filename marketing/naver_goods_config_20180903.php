<div class="page-header js-affix">
    <h3><?=end($naviMenu->location); ?> </h3>
    <div class="btn-group">
        <input type="button" value="�����ǰ ��Ȳ Ȯ��" class="btn btn-white js-layer-naver-stats"/>
        <input type="button" value="����" class="btn btn-red" id="batchSubmit"/>
    </div>
</div>


<form id="frmSearchGoods" name="frmSearchGoods" method="get" class="js-form-enter-submit">
    <div class="table-title gd-help-manual">
        <?php if($search['delFl'] =='y') { echo "���� "; } ?>��ǰ �˻�
        <?php if(empty($searchConfigButton) && $searchConfigButton != 'hide'){?>
            <span class="search"><button type="button" class="btn btn-sm btn-black" onclick="set_search_config(this.form)">�˻���������</button></span>
        <?php }?>
    </div>

    <div class="search-detail-box">
        <input type="hidden" name="detailSearch" value="<?=$search['detailSearch']; ?>"/>
        <input type="hidden" name="delFl" value="<?=$search['delFl']; ?>"/>
        <table class="table table-cols">
            <colgroup>
                <col class="width-md"/>
                <col>
                <col class="width-md"/>
                <col/>
            </colgroup>
            <tbody>
            <tr>
                <th>ī�װ�</th>
                <td class="contents" colspan="3">
                    <div class="form-inline">
                        <?=$cate->getMultiCategoryBox(null, $search['cateGoods']); ?>
                        <label class="checkbox-inline mgl10">
                            <input type="checkbox" name="categoryNoneFl" value="y" <?=gd_isset($checked['categoryNoneFl']['y']); ?>> ī�װ� ������ ��ǰ
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <th>�˻���</th>
                <td>
                    <div class="form-inline">
                        <?=gd_select_box('key', 'key', $search['combineSearch'], null, $search['key'], null); ?>
                        <input type="text" name="keyword" value="<?=$search['keyword']; ?>" class="form-control"/>
                    </div>
                </td>
                <th>�귣��</th>
                <td>
                    <div class="form-inline">

                        <label><input type="button" value="�귣�弱��" class="btn btn-sm btn-gray"  onclick="layer_register('brand', 'radio')"/></label>

                        <label class="checkbox-inline mgl10"><input type="checkbox" name="brandNoneFl" value="y" <?=gd_isset($checked['brandNoneFl']['y']); ?>> �귣�� ������ ��ǰ</label>

                        <div id="brandLayer" class="selected-btn-group <?=!empty($search['brandCd']) ? 'active' : ''?>">
                            <h5>���õ� �귣�� : </h5>
                            <?php if (empty($search['brandCd']) === false) { ?>
                                <div id="info_brand_<?= $search['brandCd'] ?>" class="btn-group btn-group-xs">
                                    <input type="hidden" name="brandCd" value="<?= $search['brandCd'] ?>"/>
                                    <input type="hidden" name="brandCdNm" value="<?= $search['brandCdNm'] ?>"/>
                                    <span class="btn"><?= $search['brandCdNm'] ?></span>
                                    <button type="button" class="btn btn-icon-delete" data-toggle="delete" data-target="#info_brand_<?= $search['brandCd'] ?>">����</button>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </td>
            </tr>
            <tr>
                <th>��ǰ���� ����</th>
                <td>
                    <label class="radio-inline"><input type="radio" name="goodsDisplayFl" value="" <?=gd_isset($checked['goodsDisplayFl']['']); ?> />��ü</label>
                    <label class="radio-inline"><input type="radio" name="goodsDisplayFl" value="y" <?=gd_isset($checked['goodsDisplayFl']['y']); ?> />������</label>
                    <label class="radio-inline"><input type="radio" name="goodsDisplayFl" value="n" <?=gd_isset($checked['goodsDisplayFl']['n']); ?> />�������</label>
                </td>
                <th>��ǰ�Ǹ� ����</th>
                <td>
                    <label class="radio-inline"><input type="radio" name="goodsSellFl" value="" <?=gd_isset($checked['goodsSellFl']['']); ?> />��ü</label>
                    <label class="radio-inline"><input type="radio" name="goodsSellFl" value="y" <?=gd_isset($checked['goodsSellFl']['y']); ?> />�Ǹ���</label>
                    <label class="radio-inline"><input type="radio" name="goodsSellFl" value="n" <?=gd_isset($checked['goodsSellFl']['n']); ?> />�Ǹž���</label>
                </td>
            </tr>
            <tr>
                <th>�Ǹ� ���</th>
                <td>
                    <label class="radio-inline"><input type="radio" name="stockFl" value="" <?=gd_isset($checked['stockFl']['']); ?> />��ü</label>
                    <label class="radio-inline"><input type="radio" name="stockFl" value="n" <?=gd_isset($checked['stockFl']['n']); ?> />������ �Ǹ�</label>
                    <label class="radio-inline"><input type="radio" name="stockFl" value="y" <?=gd_isset($checked['stockFl']['y']); ?> />����� ����</label>
                </td>
                <th>ǰ�� ����</th>
                <td>
                    <label class="radio-inline"><input type="radio" name="soldOut" value="" <?=gd_isset($checked['soldOut']['']); ?> />��ü</label>
                    <label class="radio-inline"><input type="radio" name="soldOut" value="y" <?=gd_isset($checked['soldOut']['y']); ?> />ǰ��</label>
                    <label class="radio-inline"><input type="radio" name="soldOut" value="n" <?=gd_isset($checked['soldOut']['n']); ?> />����</label>
                </td>
            </tr>
            <tr>
                <th>���̹����� ���⿩��</th>
                <td colspan="3">
                    <label class="radio-inline"><input type="radio" name="naverFl" value="" <?=gd_isset($checked['naverFl']['']); ?> />��ü</label>
                    <label class="radio-inline"><input type="radio" name="naverFl" value="y" <?=gd_isset($checked['naverFl']['y']); ?> />������</label>
                    <label class="radio-inline"><input type="radio" name="naverFl" value="n" <?=gd_isset($checked['naverFl']['n']); ?> />�������</label>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="table-btn">
        <input type="submit" value="�˻�" class="btn btn-lg btn-black">
    </div>


    <div class="table-header">
        <div class="pull-left">
            �˻� <strong><?=number_format($page->recode['total']);?></strong>�� /
            ��ü <strong><?=number_format($page->recode['amount']);?></strong>��
        </div>
        <div class="pull-right form-inline">
            <?=gd_select_box('sort', 'sort', $search['sortList'], null, $search['sort'], null); ?>
            <?=gd_select_box('pageNum', 'pageNum', gd_array_change_key_value([10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 200, 300, 500]), '�� ����', Request::get()->get('pageNum'), null); ?>
        </div>
    </div>
    <input type="hidden" name="searchFl" value="y">
    <input type="hidden" name="applyPath" value="<?=gd_php_self()?>">
</form>


<form id="frmBatchNaver" name="frmBatchNaver" action="../goods/goods_ps.php"    target="ifrmProcess" method="post">
    <input type="hidden" name="mode" value="batch_naver_config" />
    <?php
    foreach ($batchAll as $key => $val) {
        echo '<input type="hidden" name="queryAll['.$key.']" value="'.$val.'" />'.chr(10);
    }
    ?>
    <div class="table-responsive">
        <table class="table table-rows table-fixed">
            <thead>
            <tr>
                <th class="width-2xs center" rowspan="2"><input type="checkbox" class="js-checkall" data-target-name="arrGoodsNo[]"></th>
                <th class="width-2xs center" rowspan="2">��ȣ</th>
                <th class="width-xs" rowspan="2">�̹���</th>
                <th class="center" rowspan="2">��ǰ��</th>
                <th class="width-xs center" rowspan="2">���̹� ����<br/>���⿩��</th>
                <th class="width-xs center" rowspan="2">���޻�</th>
                <th class="width-md center" colspan="2">�������</th>
                <th class="width-md center" colspan="2">�ǸŻ���</th>
                <th class="width-xs  center" rowspan="2">ǰ������</th>
                <th class="width-xs  center" rowspan="2">���</th>
                <th class="width-md center" rowspan="2">�ǸŰ�</th>
                <th class="width-md center" rowspan="2">��ǰ����</th>
            </tr>
            <tr>
                <th class="width-2xs center">PC</th>
                <th class="width-2xs center">�����</th>
                <th class="width-2xs center">PC</th>
                <th class="width-2xs center">�����</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (gd_isset($data) && count($data) > 0 ) {
                $arrGoodsDisplay = ['y' => '������', 'n' => '�������'];
                $arrGoodsSell = ['y' => '�Ǹ���', 'n' => '�Ǹž���'];
                foreach ($data as $key => $val) {
                    if ($val['goodsDiscountFl'] == 'y') {
                        if ($val['goodsDiscountUnit'] == 'price') $goodsDiscount = gd_currency_symbol() . $val['goodsDiscount'] . gd_currency_string();
                        else $goodsDiscount = $val['goodsDiscount'] . '%';
                    } else $goodsDiscount = '������';

                    list($totalStock,$stockText) = gd_is_goods_state($val['stockFl'],$val['totalStock'],$val['soldOutFl']);

                    ?>
                    <tr>
                        <td class="center number">
                            <input type="checkbox" name="arrGoodsNo[]" value="<?=$val['goodsNo']; ?>"/>
                        </td>
                        <td class="center"><?=number_format($page->idx--); ?></td>
                        <td class="center">
                            <?=gd_html_goods_image($val['goodsNo'], $val['imageName'], $val['imagePath'], $val['imageStorage'], 40, $val['goodsNm'], '_blank'); ?>
                        </td>
                        <td>
                            <a href="../goods/goods_register.php?goodsNo=<?=$val['goodsNo']; ?>" target="_blank"><span class="emphasis_text"><?=$val['goodsNm']; ?></span></a>
                        </td>
                        <td class="center"><?=$arrGoodsDisplay[$val['naverFl']]; ?></td>
                        <td class="center"><?= $val['scmNm'] ?></td>
                        <td class="center"><?=$arrGoodsDisplay[$val['goodsDisplayFl']]; ?></td>
                        <td class="center"><?=$arrGoodsDisplay[$val['goodsDisplayMobileFl']]; ?></td>
                        <td class="center"><?=$arrGoodsSell[$val['goodsSellFl']]; ?></td>
                        <td class="center"><?=$arrGoodsSell[$val['goodsSellMobileFl']]; ?></td>
                        <td class="center"><?=$stockText?></td>
                        <td class="center"><?=$totalStock?></td>
                        <td class="center number">
                            <div class="form-inline"><?=gd_currency_symbol(); ?><?=gd_money_format($val['goodsPrice']); ?><?=gd_currency_string(); ?></div>
                        </td>
                        <td class="center"><?=$goodsDiscount?></td>
                    </tr>
                    <?php
                }
            }  else {

                ?>
                <tr><td class="no-data" colspan="10">�˻��� ������ �����ϴ�.</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="center"><?=$page->getPage();?></div>
    <div class="mgt10"></div>
    <div>
        <label class="checkbox-inline"><input type="checkbox" id="batchAll" name="batchAll" value="y" />�˻��� ��ǰ ��ü(<?=number_format($page->recode['total']);?>�� ��ǰ)�� �����մϴ�.</label>
        <p class="notice-danger mgt5">��ǰ���� ���� ��� ������մϴ�. �����ϸ� �� �������� �����Ͽ� �����ϼ���.</p>
    </div>
    <div>
        <table class="table table-cols" id="setNaverConfig">
            <colgroup><col class="width-md" /><col /></colgroup>
            <tr>
                <th class="center">
                    ���̹� ���� ���⼳��
                </th>
                <td>
                    <label class="radio-inline"><input type="radio" name="naverFl" value="y"  checked />������</label>
                    <label class="radio-inline"><input type="radio" name="naverFl" value="n" />�������</label>
                </td>
            </tr>
        </table>
    </div>
</form>

<script type="text/javascript">
    <!--

    $(document).ready(function(){

        $(".js-layer-naver-stats").click(function(e){
            layer_add_info('naver_stats');
        });

        $( "#batchSubmit" ).click(function() {

            var msg = '';

            if ($('#batchAll:checked').length == 0) {
                if ($('input[name="arrGoodsNo[]"]:checked').length == 0) {
                    $.warnUI('�׸� üũ', '���õ� �׸��� �����ϴ�.');
                    return false;
                }

                msg += '���õ� ��ǰ�� ';
            } else {
                msg += '�˻��� ��ü ��ǰ�� ';
            }

            msg += '���̹� ���� ���� ���¸� '+$('#setNaverConfig input[name="naverFl"]:checked').closest('label').text()+ '�� �� \n';

            msg += '�ϰ� �����Ͻðڽ��ϱ�?\n\n';
            msg += '[����] �ϰ����� �Ŀ��� �������·� ������ �ȵǹǷ� �����ϰ� �����Ͻñ� �ٶ��ϴ�.';


            dialog_confirm(msg, function (result) {
                if (result) {
                    $( "#frmBatchNaver").submit();
                }
            });



        });


        $('select[name=\'pageNum\']').change(function () {
            $('#frmSearchGoods').submit();
        });

        $('select[name=\'sort\']').change(function () {
            $('#frmSearchGoods').submit();
        });


    });

    /**
     * ī�װ� �����ϱ� Ajax layer
     */
    function layer_register(typeStr, mode, isDisabled) {

        var addParam = {
            "mode": mode
        };

        // ���̾� â

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
    //-->
</script>
