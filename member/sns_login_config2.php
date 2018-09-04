<form id="form" name="form" action="sns_login_config2_ps.php" method="post" target="ifrmProcess">
    <div class="page-header js-affix">
        <h3><?php echo end($naviMenu->location); ?></h3>
        <input type="submit" value="저장" class="btn btn-red"/>
    </div>


	<div class="table-title">
        카카오 로그인 사용 설정
    </div>
    <table class="table table-cols">
        <colgroup>
            <col class="width-md"/>
            <col/>
        </colgroup>
        <tbody>
        <tr>
            <th>사용 여부</th>
            <td>
                <label class="radio-inline">
                    <input type="radio" class="js-radio-sns-login-use" name="snsLoginUse[kakao]" id="snsLoginUseKakao_Y" value="y" <?= $checked['snsLoginUse']['kakao']['y']; ?>>
                    사용함
                </label>
                <label class="radio-inline">
                    <input type="radio" class="js-radio-sns-login-use" name="snsLoginUse[kakao]" id="snsLoginUseKakao_N" value="n" <?= $checked['snsLoginUse']['kakao']['n']; ?>>
                    사용안함
                </label>
                <div class="mgt5">
                    <span class="notice notice-info">사용함으로 선택 시 쇼핑몰에 페이스북 로그인 영역이 노출되지 않으면 스킨패치를 진행하시기 바랍니다.</span>
                </div>
            </td>
        </tr>
		<tr>
            <th>개발 여부</th>
            <td>
                <label class="radio-inline">
                    <input type="radio" class="js-radio-sns-login-dev" name="snsLoginDev[kakao]" id="snsLoginDevKakao_Y" value="y" <?= $checked['snsLoginDev']['kakao']['y']; ?>>
                    개발중
                </label>
                <label class="radio-inline">
                    <input type="radio" class="js-radio-sns-login-dev" name="snsLoginDev[kakao]" id="snsLoginDevKakao_N" value="n" <?= $checked['snsLoginDev']['kakao']['n']; ?>>
                    개발끝
                </label>
                <div class="mgt5">
                    <span class="notice notice-info">위 설정 중 '사용 여부'와 관련없이 관리자 로그인시 소셜로그인/소셜회원가입 버튼이 노출 됩니다</span>
                </div>
            </td>
        </tr>
        <tr>
            <th>App ID</th>
            <td>
                <label>
                    <input type="text" name="appId[kakao]" id="appIdKakao" value="<?= $appId['kakao']; ?>" class="form-control width-2xl useFl" />
                </label>
            </td>
        </tr>
        <tr style="display: none;">
            <th>App Secret</th>
            <td>
                <label>
                    <input type="text" name="appSecret[kakao]" id="appSecretKakao" value="11" class="form-control width-2xl useFl" />
                </label>
            </td>
        </tr>
        </tbody>
    </table>
    
</form>
<script type="text/javascript">
    <!--
    $(document).ready(function () {
        $('.js-radio-sns-login-use').change(on_change_sns_login_use).filter(':checked').trigger('change');

        function on_change_sns_login_use() {
            var $table = $(this).closest('table.table');
            $table.find('input:text:eq(0)').prop('disabled', !(this.value === 'y' && this.checked));
            $table.find('input:text:eq(1)').prop('disabled', !(this.value === 'y' && this.checked));
        }
    });
    //-->
</script>
