<?php
/**
 * ���� �ֹ���ȣ�� ����Ʈ ���̾ƿ�
 * �ֹ�����|�Աݴ�� ����Ʈ���� ���
 *
 * !����! CRM �ֹ�����, �ֹ���, Ŭ�������� ����Ʈ, ȯ�һ� ��� ���ÿ� �����Ǿ�� �Ѵ�.
 *
 * @author Jong-tae Ahn <qnibus@godo.co.kr>
 */
use Component\Naver\NaverPay;

?>

<div class="table-responsive">
    <table class="table table-rows order-list">
        <thead>
        <tr>
            <th class="width3p">
                <input type="checkbox" value="y" class="js-checkall" data-target-name="statusCheck"/>
            </th>
            <th class="width3p">��ȣ</th>
            <th class="width5p">���� ����</th>
            <th class="width5p">�ֹ��Ͻ�</th>
           <?php if ($currentStatusCode === 'o') { ?>
                <th class="width5p">�������</th>
            <?php } ?>
            <th class="width7p">�ֹ���ȣ</th>
            <th class="width7p">�ֹ���</th>
            <th>�ֹ���ǰ</th>
            <th class="width5p">�� �ݾ�</th>
            <?php if (!$isProvider) { ?>
                <th class="width5p">�� �����ݾ�</th>
			<?php } ?>            
			<th class="width3p">�������</th><?php //Ʃ�� ������� ��µǰ� ���� 2018-09-04 ?>
            <th class="width5p">������</th>
            <?php if ($currentStatusCode !== 'o') { ?>
                <th class="width5p">��������</th>
            <?php } ?>
            <?php if ($currentStatusCode === 'o') { ?>
                <?php if (!$isProvider) { ?>
                <th class="width5p">�Ա���</th>
                <th class="width10p">�Աݰ���</th>
                <?php } ?>
            <?php } else { ?>
            <th class="width3p">�̹��</th>
            <th class="width3p">�����</th>
            <th class="width3p">��ۿϷ�</th>
            <th class="width3p">���</th>
            <th class="width3p">��ȯ</th>
            <th class="width3p">��ǰ</th>
            <th class="width3p">ȯ��</th>
            <?php } ?>
            <?php if (!$isProvider) { ?>
            <th class="width5p">�����ڸ޸�</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $naverPay = new NaverPay();
        if (empty($data) === false && is_array($data)) {
            $sortNo = 1; // ��ȣ ����
            $totalCnt = 0; // �ֹ��� ���� ����
            $totalGoods = 0; // �ֹ��� ���� ����
            $totalPrice = 0; // �ֹ� �� �ݾ� ����
			//echo '<pre>';print_r($data);exit;
            foreach ($data as $orderNo => $orderData) {
                $totalCnt++; // �ֹ��� ����
                foreach ($orderData['goods'] as $sKey => $sVal) {
                    foreach ($sVal as $dKey => $dVal) {
                        foreach ($dVal as $key => $val) {
                            if ($key > 0) {
                                continue;
                            }
                            if ($val['orderChannelFl'] == 'naverpay') {
                                $checkoutData = json_decode($val['checkoutData'], true);
                                if ($naverPay->getStatusText($checkoutData)) {
                                    $naverImg = sprintf("<img src='%s' > ", \UserFilePath::adminSkin('gd_share', 'img', 'channel_icon', 'naverpay.gif')->www());
                                    $val['orderStatusStr'] .= '<br>(' . $naverImg . $naverPay->getStatusText($checkoutData) . ')';
                                }
                            }
                            $totalGoods++; // ��ǰ ����
                            if ($key === 0) {
                                $totalPrice = $totalPrice + $val['settlePrice']; // �ֹ� �� �ݾ�(����)
                            }
                            if (in_array($val['statusMode'], $statusListCombine)) {
                                $checkBoxCd = $orderNo;
                            } else {
                                $checkBoxCd = $orderNo . INT_DIVISION . $val['sno'];
                            }

                            // �ֹ��ϰ�ó�� ���ܴ�� ��Ȱ��ȭ
                            if ($isUserHandle) {
                                $checkDisabled = ($isUserHandle && $val['userHandleFl'] != 'r' ? 'disabled="disabled"' : '');
                            } else {
                                $checkDisabled = '';
                            }
                            ?>
                            <tr class="text-center" data-mall-sno="<?=$val['mallSno']?>">
                                <?php if (in_array($currentStatusCode, $statusListCombine)) { ?>
                                    <td>
                                        <input type="checkbox" name="statusCheck[<?= $val['statusMode'] ?>][]" <?= $checkDisabled ?> value="<?= $checkBoxCd; ?>"/>
                                        <input type="hidden" name="orderStatus[<?= $val['statusMode'] ?>][]" value="<?= $val['orderStatus']; ?>"/>
                                        <input type="hidden" name="escrowCheck[<?= $val['statusMode'] ?>][]" <?= $checkDisabled ?> value="<?= $val['escrowFl'] . $val['escrowDeliveryFl']; ?>"/>
                                        <?php if (in_array($currentStatusCode, ['r', 'e', 'b'])) { ?>
                                            <input type="hidden" name="handleSno[<?= $val['statusMode'] ?>][]" value="<?= $val['handleSno']; ?>"/>
                                            <input type="hidden" name="beforeStatus[<?= $val['statusMode'] ?>][]" value="<?= $val['beforeStatus']; ?>"/>
                                        <?php } ?>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <input type="checkbox" name="statusCheck[<?= $val['statusMode'] ?>][]" <?= $checkDisabled ?> value="<?= $checkBoxCd; ?>"/>
                                        <input type="hidden" name="orderStatus[<?= $val['statusMode'] ?>][]" value="<?= $val['orderStatus']; ?>"/>
                                        <input type="hidden" name="escrowCheck[<?= $val['statusMode'] ?>][]" <?= $checkDisabled ?> value="<?= $val['escrowFl'] . $val['escrowDeliveryFl']; ?>"/>
                                        <?php if (in_array($currentStatusCode, ['r', 'e', 'b'])) { ?>
                                            <input type="hidden" name="handleSno[<?= $val['statusMode'] ?>][]" value="<?= $val['handleSno']; ?>"/>
                                            <input type="hidden" name="beforeStatus[<?= $val['statusMode'] ?>][]" value="<?= $val['beforeStatus']; ?>"/>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                                <td class="font-num">
                                    <small><?= $page->idx--; ?></small>
                                </td>
                                <td class="font-kor">
                                    <span class="flag flag-16 flag-<?=$val['domainFl']?>"></span>
                                    <?=$val['mallName']?>
                                </td>
                                <td class="font-date nowrap"><?= str_replace(' ', '<br>', gd_date_format('Y-m-d H:i', $val['regDt'])); ?></td>
                                <?php if ($currentStatusCode === 'o') { ?>
                                    <td class="font-date nowrap"><?=gd_interval_day($val['regDt'], date('Y-m-d H:i:s'));?>��</td>
                                <?php } ?>
                                <td class="order-no">
                                    <?php if ($val['firstSaleFl'] == 'y') { ?>
                                        <p class="mgb0"><img src="<?=PATH_ADMIN_GD_SHARE?>img/order/icon_firstsale.png" alt="ù�ֹ�" /></p>
                                    <?php } ?>
                                    <a href="./order_view.php?orderNo=<?= $orderNo; ?>" target="_blank" title="�ֹ���ȣ" class="font-num<?=$isUserHandle ? ' js-link-order' : ''?>" data-order-no="<?=$orderNo?>" data-is-provider="<?= $isProvider ? 'true' : 'false' ?>"><?= $orderNo; ?></a>
                                    <?php if ($val['orderChannelFl'] == 'naverpay') { ?>
                                        <p>
                                            <a href="./order_view.php?orderNo=<?= $orderNo; ?>" target="_blank" title="�ֹ���ȣ" class="font-num<?=$isUserHandle ? ' js-link-order' : ''?>" data-order-no="<?=$orderNo?>" data-is-provider="<?= $isProvider ? 'true' : 'false' ?>"><img
                                                    src="<?= UserFilePath::adminSkin('gd_share', 'img', 'channel_icon', 'naverpay.gif')->www() ?>"/> <?= $val['apiOrderNo']; ?></a>
                                        </p>
                                    <?php } else if($val['orderChannelFl'] == 'payco') { ?>
                                        <img src="<?= UserFilePath::adminSkin('gd_share', 'img', 'channel_icon', 'payco.gif')->www() ?>"/>
                                    <?php } ?>
                                </td>
                                <td class="js-member-info" data-member-no="<?= $val['memNo'] ?>" data-member-name="<?= $val['orderName'] ?>"
                                                               data-cell-phone="<?= $val['smsCellPhone'] ?>">
                                    <?= $val['orderName'] ?>
                                    <p class="mgb0">
                                        <?php if (!$val['memNo']) { ?>
                                            <?php if (!$val['memNoCheck']) { ?>
                                                <span class="font-kor">(��ȸ��)</span>
                                            <?php } else { ?>
                                                <span class="font-kor">(Ż��ȸ��)</span>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if (!$isProvider) { ?>
                                                <button type="button" class="btn btn-link font-eng js-layer-crm" data-member-no="<?= $val['memNo'] ?>">(<?= $val['memId'] ?>/<?=$val['groupNm']?>)
                                            <?php } else { ?>
                                                (<?= $val['memId'] ?>/<?=$val['groupNm']?>)
                                            <?php } ?>
                                            </button>
                                        <?php } ?>
                                    </p>
                                </td>
                                <td class="text-left"><?= $val['orderGoodsNm'] ?></td>
                                <td><?= gd_currency_display($val['totalGoodsPrice']); ?></td>
                                <?php if (!$isProvider) { ?>
                                    <td><?= gd_currency_symbol() ?><?= gd_money_format($val['totalSettlePrice']); ?></span><?= gd_currency_string() ?></td>
								<?php } ?>
                                <?php //Ʃ�� ������� ��µǰ� ���� 2018-09-04 ?>
									<td>
                                        <?php if (is_file(UserFilePath::adminSkin('gd_share', 'img', 'settlekind_icon', 'icon_settlekind_' . $val['settleKind'] . '.gif'))) { ?>
                                            <?= gd_html_image(UserFilePath::adminSkin('gd_share', 'img', 'settlekind_icon', 'icon_settlekind_' . $val['settleKind'] . '.gif')->www(), $val['settleKindStr']); ?>
                                        <?php } ?>
                                        <?php if ($val['divisionUseDeposit'] > 0) { ?>
                                            <?= gd_html_image(UserFilePath::adminSkin('gd_share', 'img', 'settlekind_icon', 'icon_settlekind_gd.gif')->www(), $val['settleKindStr']); ?>
                                        <?php } ?>
                                        <?php if ($val['divisionUseMileage'] > 0) { ?>
                                            <?= gd_html_image(UserFilePath::adminSkin('gd_share', 'img', 'settlekind_icon', 'icon_settlekind_gm.gif')->www(), $val['settleKindStr']); ?>
                                        <?php } ?>
                                        <?php if ($val['receiptFl'] != 'n') {
                                            //echo gd_html_image(PATH_ADMIN_GD_SHARE . 'image/ico_receipt_' . $val['receiptFl'] . '.gif', null);
                                        } ?>
                                    </td>
								<?php //Ʃ�� ������� ��µǰ� ���� 2018-09-04 ?>                                
                                <td><?= $val['receiverName'] ?></td>
                                <?php if (!in_array($currentStatusCode, ['o'])) { ?>
                                    <td>
                                        <div title="�ֹ� ��ǰ�� �ֹ� ����">
                                        <?php if (in_array(substr($val['orderStatus'], 0, 1), ['o','c'])) { ?>
                                            �̰���
                                        <?php } elseif (in_array(substr($val['orderStatus'], 0, 1), ['f'])) { ?>
                                            <?=$val['orderStatusStr']?>
                                        <?php } else { ?>
                                            ����Ȯ��
                                        <?php } ?>
                                        </div>
                                    </td>
                                <?php } ?>
                                <?php if ($currentStatusCode === 'o') {//�Աݴ�⿡�� �Ա���/�Աݰ��°� ǥ�õǵ��� ó�� ?>
                                    <?php if (!$isProvider) { ?>
                                    <td>
                                        <?php
                                        if ($val['statusMode'] == 'o' && $val['settleKind'] == 'gb') {        // �ֹ� ������ ��� �Ա��ڸ�
                                            echo '<span title="�Ա��ڸ�">' . $val['bankSender'] . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= str_replace(STR_DIVISION, ' / ', gd_isset($val['bankAccount'])); ?></td>
                                    <?php } ?>
                                <?php } else { ?>
                                <td class="font-num point1"><?=number_format($val['noDelivery'])?></td>
                                <td class="font-num point1"><?=number_format($val['deliverying'])?></td>
                                <td class="font-num point1"><?=number_format($val['deliveryed'])?></td>
                                <td class="font-num point1"><?=number_format($val['cancel'])?></td>
                                <td class="font-num point1"><?=number_format($val['exchange'])?></td>
                                <td class="font-num point1"><?=number_format($val['back'])?></td>
                                <td class="font-num point1"><?=number_format($val['refund'])?></td>
                                <?php } ?>
                                <?php if (!$isProvider) { ?>
                                <td class="text-center" data-order-no="<?= $val['orderNo'] ?>" data-reg-date="<?= $val['regDt'] ?>">
                                    <button type="button" class="btn btn-sm btn-<?= $val['adminMemo'] != '' ? 'gray js-html-popover' : 'white' ?> js-super-admin-memo" title="�����ڸ޸�" data-placement="left" data-content="<?=nl2br($val['adminMemo'])?>">����</button>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php
                        }
                    }
                }
            }
        } else {
            ?>
            <tr>
                <td colspan="20" class="no-data">
                    �˻��� �ֹ��� �����ϴ�.
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

