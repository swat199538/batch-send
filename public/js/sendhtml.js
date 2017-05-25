var isAjax = 0;

$('.receive-text').on('focus', function () {
    $(this).parent().addClass('focus');
});
$('.receive-text').on('blur', function () {
    $(this).parent().removeClass('focus');
});

$("#signature-view").text($("#signature").val());
$("#content-view").text($("#msg-content").val());

function resetWidth($obj) {
    var text = $obj.val().length;
    var current = parseInt(text)*14;
    if (current === 0){
        current = 14;
    } else if (current > 111){
        current = 111
    }
    $obj.css('width', current+'px');
    $("#msg-content").css('text-indent', current+14+'px');
}

function countWord()
{
    var sign = $("#signature").val().length+2;
    var content = $("#msg-content").val().length;
    var wordCount = sign+content;
    var msgCount = parseInt(wordCount / 64) + 1;
    $("#msgCount").text(msgCount);
    $("#wordCount").text(wordCount);
}

function checkPhone(numbers)
{
    layer.msg('玩命检查中，请稍等',{
        time:100000
    });
    var trueNumers = [];
    var error = 0;
    var repeat = 0;
    //去重和检查格式
    for (var i=0; i< numbers.length; i++){
        if (trueNumers.indexOf(numbers[i]) === -1){
            if((/^1[34578]{1}\d{9}$/.test(numbers[i]))){
                trueNumers.push(numbers[i]);
            } else {
                error ++;
            }
        } else {
            repeat ++;
        }
    }
    var trueDome = '';
    for (var i in  trueNumers){
        trueDome += trueNumers[i]+'\n';
    }
    $("#phone-numbers").val(trueDome);
    $("#success-count").text(trueNumers.length);
    $("#error-count").text(error);
    $("#repeat-count").text(repeat);
    layer.closeAll();
}

function severCheckPhone(number)
{
    if (isAjax == 0){
        layer.msg('玩命检查中！',{
            time:100000
        });
        isAjax = 1;
        $.post(
            '{{url('/check/phone')}}',
            {
                'number':number,
                '_token':'{{csrf_token()}}'
            },
            function (data) {
                isAjax = 0;
                data = $.parseJSON(data);
                if (data['code'] == 'success'){
                    var trueDome = '';
                    for (var i in  data['msg']['phone']){
                        trueDome += data['msg']['phone'][i]+'\n';
                    }
                    $("#phone-numbers").val(trueDome);
                    $("#success-count").text(data['msg']['success']);
                    $("#wordCount").text(data['msg']['success']);
                    $("#error-count").text(data['msg']['illegal']);
                    $("#repeat-count").text(data['msg']['repeat']);
                    layer.closeAll();
                } else {
                    layer.closeAll();
                    layer.msg(data['msg']);
                }
            });
    }
}

$("#signature").on('focus', function () {
    var info = $(this).val();
    if (info == '请输入签名'){
        $(this).val('');
        resetWidth($(this));
    }
});
$("#signature").on('keyup', function () {
    var text = $(this).val();
    if (text.length > 9){
        text = text.substring(0, 8);
        $(this).val(text);
    }
    resetWidth($(this));
    countWord();
});
$("#signature").on('change', function () {
    var text = $(this).val();
    if (text == ''){
        $(this).val('请输入签名');
        resetWidth($(this));
    }
    $("#signature-view").text($(this).val());
});

$("#msg-content").on('blur', function () {
    $("#content-view").text($(this).val());
    countWord();
});

$("#check-phone").on('click', function () {
    //手机号码检查
    var numbers = $("#phone-numbers").val().split('\n');
    if (numbers.length <= 15000){
        checkPhone(numbers);
    } else {
        severCheckPhone(numbers);
    }

    //检查签名
    var signature = $("#signature").val();
    var contet = $("#msg-content").val();

    var checkSign
    var checkLength

    if((/[a-zA-Z\d\u4e00-\u9fa5]{3,7}/g.test(signature)) && signature!='请输入签名'){
        checkSign = true;
    } else {
        checkSign = false;
        $("#chieck_info").css('color', 'red');
        $("#chieck_info").text('签名只能是中文数字字母3到8个字');
    }

    //检查内容长度
    if (contet.length + signature.length + 2 <= 325 && contet.length > 0){
        checkLength = true;
    } else {
        checkLength = false;
        $("#chieck_info").css('color', 'red');
        $("#chieck_info").text('短信内容长度325个字');
    }

    if (checkSign && checkLength){
        $("#chieck_info").css('color', 'green');
        $("#chieck_info").text('检查成功可以发送');
        $("#sendSms").removeClass('disability');
        $("#sendSms").on('click', function () {
            $("#sendInfo").submit();
        });
    }

});

$("#importBtn").click(function () {
    $("#excel_file").click();
});

$("#excel_file").change(function () {
    //弹出等待层
    layer.msg('玩命导入中',{
        time:100000
    });
    var formData = new FormData();
    formData.append('file', $("#excel_file")[0].files[0]);
    formData.append('_token', '{{csrf_token()}}');
    $.ajax({
        url: '{{url('upload')}}',
        type: 'POST',
        cache: false,
        data: formData,
        processData: false,
        contentType: false
    }).done(function(data) {
        data = $.parseJSON(data);
        if (data['code'] == 'error'){
            layer.msg(data['msg'],{
                time:2000
            });
        } else {
            layer.closeAll();
            var phone = '';
            for (var i in data['msg']['number']){
                phone += data['msg']['number'][i]+'\n';
            }
            var old = $("#phone-numbers").val();
            $("#phone-numbers").val(old+phone);
            $("#success-count").text(data['msg']['success']);
            $("#countWord").text(data['msg']['success']);
            $("#repeat-count").text(data['msg']['repeat']);
            $("#error-count").text(data['msg']['illegal']);
        }
    }).fail(function() {
        alert('文件上传失败！');
    });
});