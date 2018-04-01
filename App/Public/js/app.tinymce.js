(function() {
    tinymce.PluginManager.add('app_custom_mce_button', function(editor, url) {
        editor.addButton('app_custom_mce_button_photo', {
            icon: 'false',
            image: '//1.bp.blogspot.com/-FBJgw0Wkv1s/WsCrMcTxCXI/AAAAAAAABT8/-NAOZvk1SOsf3TcIpifR6mI163nky3WGACLcBGAs/s1600/photo.png',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Thêm Ảnh cho Bài Viết',
                    width: 600,
                    height: 250,
                    body: [{
                        label: 'Link ảnh',
                        type: 'textbox',
                        name: 'LinkPhoto',
                    }, {
                        label: 'Tiêu đề ảnh',
                        type: 'textbox',
                        name: 'altPhoto',
                    }, {
                        label: 'Mổ tả ảnh',
                        type: 'textbox',
                        name: 'descPhoto',
                        multiline: true,
                    }],
                    onsubmit: function(e) {
                        editor.insertContent(
                            '[photo link="'+e.data.LinkPhoto+'" tieude="'+e.data.altPhoto+'" mota="'+e.data.descPhoto+'" /]',
                        );
                    }
                });
            },
        });
        editor.addButton('app_custom_mce_button_video', {
            icon: 'false',
            image: '//4.bp.blogspot.com/-TGv2rp9N03w/WsCrMf76PLI/AAAAAAAABT4/5i67-lRe01oSFqd9JvtQmCuCBzl_aj0OACLcBGAs/s1600/video.png',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Thêm video cho Bài Viết',
                    width: 600,
                    height: 250,
                    body: [{
                        label: 'Link video',
                        type: 'textbox',
                        name: 'LinkVideo',
                    }, {
                        label: 'Tiêu đề video',
                        type: 'textbox',
                        name: 'altVideo',
                    }, {
                        label: 'Mổ tả video',
                        type: 'textbox',
                        name: 'descVideo',
                        multiline: true,
                    }],
                    onsubmit: function(e) {
                        editor.insertContent(
                            '[xvideo link="'+e.data.LinkVideo+'" tieude="'+e.data.altVideo+'" noidung="'+e.data.descVideo+'" /]',
                        );
                    }
                });
            },
        });
    });
})();