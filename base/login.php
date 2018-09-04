<form id="frmLogin" name="frmLogin" action="login_ps.php" method="post">
    <input type="hidden" name="mode" value="login"/>
    <input type="hidden" name="returnUrl" value="<?=$returnUrl?>"/>
    <table class="login-table">
        <tr>
            <td>
                <div class="login-layout">
                    <h1><img src="<?=PATH_ADMIN_GD_SHARE?>img/logo_main.png"></h1>
                    <div class="login-form">
                        <div class="login-input">
                            <div>
                                <input type="text" id="login" name="managerId" value="<?php echo $saveManagerId;?>" placeholder="쇼핑몰 관리 아이디" class="form-control input-lg"/>
                            </div>
                            <div>
                                <input type="password" name="managerPw" value="" placeholder="쇼핑몰 관리 비밀번호" class="form-control input-lg"/>
                            </div>
                        </div>
                        <div class="login-btn">
                            <input type="submit" value="로그인" class="btn btn-black"/>
                        </div>
                    </div>

                    <div class="login-bottom">
                        <label class="checkbox-inline checkbox-lg">
                            <input type="checkbox" name="saveId" value="y" <?php if (empty($saveManagerId) === false) { echo 'checked="checked"'; }?>> 아이디 저장
                        </label>
                        <a href="#find-password" class="btn btn-icon-passwd pull-right">아이디/비밀번호 분실</a>
                    </div>

                    <div id="panel_banner_loginPanel"></div>

                    <div class="copyright">
                        &copy; NHN <a href="http://www.godo.co.kr" target="_blank">godo<span>:</span></a> Corp All Rights Reserved.
                    </div>
                </div>
            </td>
        </tr>
    </table>
</form>

<script type="text/html" id="idPasswordFindPopover">
    <div style="width: 260px; text-align: left;padding-left:5px;">
        <h5 class="text-red bold">본사 운영자</h5>
        <ol>
            <li>
                <ol>
                    <li>아이디 분실 시<li>
                    <li>세팅메일에서 아이디를 확인할 수 있습니다.</li><br />
                </ol>
                <ol>
                    <li>고도회원 로그인</li>
                    <li>마이고도 > 쇼핑몰관리 > 쇼핑몰 목록 페이지로 이동</li>
                    <li>"서비스 관리" 항목의 [관리] 버튼 클릭</li>
                    <li>"세팅메일 받기" 항목의 [메일보내기] 버튼 클릭</li><br />
                </ol>
            </li>
            <li>
                <ol>
                    <li>아이디/비밀번호 분실 시</li>
                    <li>아이디/비밀번호를 재설정해 드립니다.</li><br />
                </ol>
                <ol>
                    <li>고도회원 로그인</li>
                    <li>마이고도 > 1:1문의/답변관리 > 1:1 문의하기 페이지</li>
                    <li>관리자 아이디/비밀번호 재설정 요청</li>
                </ol>
            </li>
        </ol>
        <h5 class="text-red bold pdt10">공급사 운영자</h5>
        <ul class="list-unstyled">
            <li>본사 담당자에게 문의주시기 바랍니다.</li>
        </ul>
    </div>
</script>
<script type="text/javascript">
    <!--
    $(document).ready(function () {
        // 로그인 폼 체크
        $('#frmLogin').validate({
            submitHandler: function (form) {
                form.target = 'ifrmProcess';
                form.submit();
            },
            rules: {
                managerId: 'required',
                managerPw: 'required'
            },
            messages: {
                managerId: '쇼핑몰 관리 아이디를 입력하세요.',
                managerPw: '쇼핑몰 관리 비밀번호를 입력하세요.'
            }
        });

        // 로그인 폼 포커스
        $("#login").focus();

        // 아이디/비밀번호 분실 팝오버 처리

        var popoverCompiled = _.template($('#idPasswordFindPopover').html());

        $('.btn-icon-passwd').popover({
            trigger: 'click',
            html: true,
            content: popoverCompiled
        });
    });
    //-->
</script>
