$(document).ready(function(){
    $('#open_sign').click(function(){
        $('.popup').addClass('activeform');
        $('.error_sign').removeClass('active')
    })
    $('.popup__close').click(function(){
        $('.popup').removeClass('activeform');
    })
    // Только цифры и максимум
    $('.onlyinp').on('input',function(){
        $(this).val(this.value.replace(/[^0-9]/g, ''));
        this.value = this.value.substr(0, $(this).attr('max'));   
    })
    // Регистрация
    $('#reg_form').submit(function(e){
        e.preventDefault();
        var form=new FormData(this);
        form=Object.fromEntries(form);
        if(form.pass_reg!= form.pass_rep){
            $('#pass_rep').val('');
            $('#pass_rep').css({
                'border-color':"red"
            });
            $('.errormsg').html('Парли не совпадают');
            return;
        }
        $.ajax({
            type: "POST",
            url: "php/reguser.php",
            data:{
                user:form
            }
        }).done(function(res){
            if(res=='logerror'){
                $('#login_res').val('');
                $('#login_res').css({
                    'border-color':"red"
                });
                $('.errormsg').html('Логин занят');
            }
            else{
                location.href='cabinet.php';
            }
        });
    })
    $('#pass_rep,#login_res').focus(function (){ 
        $(this).css({
            'border-color':"black"
        });
        $('.errormsg').html('')
        
    });
    $('#check__user').submit(function(e){
        e.preventDefault();
        var login=$('#login').val();
        var pass=$('#pass').val();
        if(login=="" || pass==""){
            $('.error_sign').addClass('active');
            $('.error_sign').html('Заполните все поля');
            return;
        }
        $.ajax({
            type: $(this).attr('method'),
            url:  $(this).attr('action'),
            data: {
                login:login,
                pass:pass
            }
        }).done(function(res){
            if(res=='404'){
                $('#login').val('');
                $('#pass').val('');
                $('.error_sign').addClass('active');
                $('.error_sign').html('Пользователь не найден');
            }
            else{
                location.reload();
            }
            
        })
    })
    $('#pass_rep,#login_res').focus(function (){ 
        $(this).css({
            'border-color':"black"
        });
        $('.errormsg').html('')
        
    });
    $('.updcount').click(function(){
        updateprice(this);   
    })
    $('#info_user').submit(function(e){
        e.preventDefault();
        var user_info=new FormData(this);
        user_info=Object.fromEntries(user_info);
        $.ajax({
            type: "POST",
            url: "php/new_info.php",
            data: {
                userinfo:user_info
            }
        }).done(function(res){  
            if(res=="errorlog"){
                $('#new_login').css({
                    'border-color':"red"
                });
                $('.errormsg').addClass('active')
                $('.errormsg').html('Логин занят');
                $('#new_login').focus(function (){ 
                    $(this).css({
                        'border':"1px solid black"
                    });
                    $('.errormsg').html('')
                    $('.errormsg').removeClass('active')
                    
                });
            }
        });
    })
    $('#form-add-product').submit(function(e){
        e.preventDefault();
        var file=new FormData(this);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: file,
            contentType: false,
            processData:false,
        }).done(function(res){
            console.log(res);
        //    $('#form-add-product').trigger('reset');
        //    $('#new-img_product').attr('src','img/download.png')
        });
    });
    $('#img_product').on('change',function(){
        var file=this.files[0];
        fr=new FileReader();
        fr.readAsDataURL(file);
        fr.onload=function(){ 
        $('#new-img_product').attr('src',fr.result)
        }
       
    });
    $('.tabs_header>ul>li').click(function(){
        $('.tabs_content>ul>li').removeClass('active');
        $('.tabs_header>ul>li').removeClass('active');
        $(this).addClass('active')
        $('.tabs_content>ul>li').eq($(this).index()).addClass('active');
    })
    $('#form-add_category').submit(function(e){
        e.preventDefault();
        var info=new FormData(this);
        info=Object.fromEntries(info);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: info
        }).done(function(res){
            $('#form-add_category').trigger('reset');
        });
    })
})
