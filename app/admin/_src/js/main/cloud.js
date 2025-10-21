$(function(){
    $('[data-rule="upgradeExpired"]').click(function(){
        new $.zui.Messager('The authorization has expired', {
            type: 'default', // 定义颜色主题
            placement: 'center', // 定义显示位置
            icon: 'info-sign',
            time: 1000
        }).show();
    });
})